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

        $purchaseReturn = $this->purchaseReturns->savePurchaseReturn($data, $request);

        $purchaseReturnStatus = $this->purchase->purchaseReturnStatus($id, $request);

        $ledger = $this->ledger->saveLedgerSales($data, $request);

        $transaction = $this->transaction->saveTransactions($data, $request);

        $purchaseReturns = $this->purchaseReturns->getPurchaseReturns();

        if ($purchaseReturn['code'] == 200 && $ledger['code'] == 200 &&
            $transaction['code'] == 200 && $purchaseReturnStatus['code'] == 200) {
            flash()->success($purchaseReturn['message']);
            flash()->success($ledger['message']);
            flash()->success($transaction['message']);
            flash()->success($purchaseReturnStatus['message']);
            return Redirect::to('secure/purchaseReturns')->with('purchaseReturns', $purchaseReturns);

        } elseif ($purchaseReturn['code'] == 422 || $ledger['code'] == 422 ||
            $transaction['code'] == 422 || $purchaseReturnStatus['code'] == 422) {
            flash()->error($purchaseReturn['message']);
            flash()->error($ledger['message']);
            flash()->error($transaction['message']);
            flash()->error($purchaseReturnStatus['message']);
        }

    }
}