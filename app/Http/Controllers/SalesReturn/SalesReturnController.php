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

        if ($salesReturn) {
            $salesReturnStatus = $this->sales->salesReturnStatus($id);
        }

        if ($salesReturn && $salesReturnStatus) {
            $ledger = $this->ledger->saveLedgerSales($data);
        }

        if ($salesReturn && $salesReturnStatus && $ledger) {
            $transaction = $this->transaction->saveTransactions($data);
        }

        $salesReturns = $this->salesReturn->getSalesReturns();

        if ($salesReturn['code'] == 200 && $ledger['code'] == 200 &&
            $transaction['code'] == 200 && $salesReturnStatus['code'] == 200) {
            flash()->success($salesReturn['message']);
            flash()->success($ledger['message']);
            flash()->success($transaction['message']);
            flash()->success($salesReturnStatus['message']);

            return Redirect::to('secure/salesReturns')->with('salesReturns', $salesReturns);

        } elseif ($salesReturn['code'] == 422 || $ledger['code'] == 422 ||
            $transaction['code'] == 422 || $salesReturnStatus['code'] == 422) {

            flash()->error($salesReturn['status']['message']);
            flash()->error($ledger['status']['message']);
            flash()->error($transaction['status']['message']);
            flash()->error($salesReturnStatus['status']['message']);
        }

    }

}