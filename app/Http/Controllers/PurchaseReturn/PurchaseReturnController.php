<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/14/2017
 * Time: 9:01 PM
 */

namespace App\Http\Controllers\PurchaseReturn;

use App\Http\Controllers\Controller;
use App\Http\Models\Ledger;
use App\Http\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Repo\Contracts\LedgerInterface;
use Repo\Contracts\PurchaseInterface;
use Repo\Contracts\PurchaseReturnsInterface;
use Repo\Contracts\TransactionInterface;

class PurchaseReturnController extends Controller
{
    private $purchaseReturns;
    private $ledger;
    private $transaction;
    private $purchase;

    public function __construct(PurchaseReturnsInterface $purchaseReturns,
                                LedgerInterface $ledger,
                                TransactionInterface $transactions,
                                PurchaseInterface $purchase)
    {
        $this->purchaseReturns = $purchaseReturns;
        $this->ledger = $ledger;
        $this->transaction = $transactions;
        $this->purchase = $purchase;
    }

    public function getPurchaseReturns($id = null,$keyword = null)
    {
        $purchaseReturns = $this->purchaseReturns->getPurchaseReturns($id);

        return view('purchaseReturns.index')->with('purchaseReturns', $purchaseReturns);
    }

    public function savePurchaseReturns(Request $request)
    {
        $data = $request->all();

        $id = $request->get('Purchase_id');

        $purchaseReturn = $this->purchaseReturns->savePurchaseReturn($data);

        $purchaseReturnStatus = $this->purchase->purchaseReturnStatus($id);

        $ledger = $this->ledger->saveLedgerSales($data);

        $transaction = $this->transaction->saveTransactions($data);


        if ($purchaseReturn['code'] == 422 || $ledger['code'] == 422 || $transaction['code'] == 422 || $purchaseReturnStatus['code'] == 422) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.CREATE_ERROR')
            ], 422);
        }

        $purchaseReturns = $this->purchaseReturns->getPurchaseReturns();
        return Redirect::to('secure/purchaseReturns.html')->with('purchaseReturns', $purchaseReturns);
    }
}