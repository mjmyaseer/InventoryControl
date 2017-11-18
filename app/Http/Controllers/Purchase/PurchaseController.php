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

    public function index()
    {
        $purchase = $this->purchase->index();
        $purchaseReturns = $this->purchaseReturns->index();

        $data = array(
            'purchase' => $purchase,
            'purchaseReturns' => $purchaseReturns
        );
        return view('purchase.index')->with('purchase', $data);
    }

    public function getIndividualGRN($id)
    {

    }

    public function addPurchase()
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
        $data = $request->all();

        $insert = $this->purchase->savePurchases($data);

        $ledger = $this->ledger->saveLedgerPurchases($data);

        $transaction = $this->transaction->saveTransactions($data);

        if ($insert['code'] == 422 || $ledger['code'] == 422 || $transaction['code'] == 422) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.CREATE_ERROR')
            ], 422);
        }

        $grn = $this->purchase->index();

        return Redirect::to('secure/purchase.html')->with('purchase', $grn);
    }
}