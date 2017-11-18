<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/17/2017
 * Time: 1:11 AM
 */
namespace App\Http\Controllers\SalesReturn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Repo\Contracts\LedgerInterface;
use Repo\Contracts\PurchaseInterface;
use Repo\Contracts\SalesInterface;
use Repo\Contracts\SalesReturnInterface;
use Repo\Contracts\TransactionInterface;

class SalesReturnController extends Controller
{
    private $salesReturn;
    private $ledger;
    private $transaction;
    private $sales;

    public function __construct(SalesReturnInterface $salesReturn,
                                LedgerInterface $ledger,
                                TransactionInterface $transaction,
                                SalesInterface $sales)
    {
        $this->salesReturn = $salesReturn;
        $this->ledger = $ledger;
        $this->transaction = $transaction;
        $this->sales = $sales;
    }

    public function getSalesReturns($id = null)
    {
        $salesReturns = $this->salesReturn->getSalesReturns($id);

        return view('salesReturns.index')->with('salesReturns', $salesReturns);
    }

    public function saveSalesReturns(Request $request)
    {
        $data = $request->all();

        $id = $request->get('Sales_id');

        $salesReturn = $this->salesReturn->saveSalesReturn($data);

        $salesReturnStatus = $this->sales->salesReturnStatus($id);

        $ledger = $this->ledger->saveLedgerSales($data);

        $transaction = $this->transaction->saveTransactions($data);

        if ($salesReturn['code'] == 422 || $ledger['code'] == 422 || $transaction['code'] == 422 || $salesReturnStatus['code'] == 422) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.CREATE_ERROR')
            ], 422);
        }

        $salesReturns = $this->salesReturn->getSalesReturns();
        return Redirect::to('secure/salesReturns.html')->with('salesReturns', $salesReturns);
    }

}