<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 10/25/2017
 * Time: 3:22 PM
 */

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Repo\Contracts\CategoryInterface;
use Repo\Contracts\CustomerInterface;
use Repo\Contracts\PurchaseInterface;
use Repo\Contracts\ItemInterface;
use Repo\Contracts\LedgerInterface;
use Repo\Contracts\PurchaseReturnsInterface;
use Repo\Contracts\SupplierInterface;
use Repo\Contracts\TransactionInterface;

class PurchaseController extends Controller
{
    private $category;
    private $item;
    private $customer;
    private $purchase;
    private $supplier;
    private $ledger;
    private $transaction;
    private $purchaseReturns;

    public function __construct(CategoryInterface $category,
                                ItemInterface $item,
                                CustomerInterface $customer,
                                SupplierInterface $supplier,
                                PurchaseInterface $purchase,
                                LedgerInterface $ledger,
                                TransactionInterface $transaction,
                                PurchaseReturnsInterface $purchaseReturns)
    {
        $this->category = $category;
        $this->item = $item;
        $this->customer = $customer;
        $this->supplier = $supplier;
        $this->purchase = $purchase;
        $this->ledger = $ledger;
        $this->transaction = $transaction;
        $this->purchaseReturns = $purchaseReturns;

    }

    public function index(Request $request)
    {
        $purchase = $this->purchase->index();
        $purchaseReturns = $this->purchaseReturns->index();

        $data = array(
            'purchase' => $purchase,
            'purchaseReturns' => $purchaseReturns,
            'request' => $request
        );
        return view('purchase.index')->with('purchase', $data);
    }

    public function getIndividualGRN($id)
    {

    }

    public function addPurchase(Request $request)
    {

        $categories = $this->category->index();
        $items = $this->item->index();
        $suppliers = $this->supplier->index();

        $data = array(
            'categories' => $categories,
            'items' => $items,
            'suppliers' => $suppliers
        );

        return view('purchase.add_grn')->with('data', $data);
    }

    public function savePurchase(Request $request)
    {
//        dd($request->all());
//        $validationRules = [
//            'supplier_id' => 'required',
//            'category' => 'required',
//            'item' => 'required',
//            'quantity' => 'required',
//            'order_date' => 'required',
//        ];
//
//        $this->validate($request, $validationRules);

        $data = $request->all();

        $insert = $this->purchase->savePurchases($data,$request);

        if ($insert) {
            $ledger = $this->ledger->saveLedgerPurchases($data,$request);
        }

        if ($insert && $ledger) {
            $transaction = $this->transaction->saveTransactions($data,$request);
        }

        $grn = $this->purchase->index();
        if ($insert['code'] == 200 && $ledger['code'] == 200 && $transaction['code'] == 200) {
            flash()->success($insert['message']);
            flash()->success($ledger['message']);
            flash()->success($transaction['message']);
            return Redirect::to('secure/purchase')->with('purchase', $grn);

        } elseif ($insert['code'] == 422) {
            flash()->error($insert['message']);
            flash()->error($ledger['message']);
            flash()->error($ledger['message']);
        }

    }
}