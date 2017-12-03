<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 10/23/2017
 * Time: 1:15 PM
 */

namespace App\Http\Controllers\Sales;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use Repo\Contracts\CategoryInterface;
use Repo\Contracts\CustomerInterface;
use Repo\Contracts\SalesInterface;
use Repo\Contracts\ItemInterface;
use Repo\Contracts\LedgerInterface;
use Repo\Contracts\TransactionInterface;

class SalesController extends Controller
{
    private $category;
    private $item;
    private $customer;
    private $sales;
    private $ledger;
    private $transaction;

    public function __construct(CategoryInterface $category,
                                ItemInterface $item,
                                CustomerInterface $customer,
                                SalesInterface $sales,
                                LedgerInterface $ledger,
    TransactionInterface $transaction
    )
    {
        $this->category = $category;
        $this->item = $item;
        $this->customer = $customer;
        $this->sales = $sales;
        $this->ledger = $ledger;
        $this->transaction = $transaction;
    }

    public function index($keyword = null)
    {
        $sales = $this->sales->index($keyword);
//dd($sales);
        return view('sales.index')->with('sales', $sales);
    }

    public function getIndividualInvoice($id)
    {

    }

    public function addSales()
    {
        $categories = $this->category->index();
//        dd($categories);
        $items = $this->item->index();
        $customers = $this->customer->index();

        $data = array(
            'categories' => $categories,
            'items' => $items,
            'customers' => $customers
        );
        return view('sales.add_sales')->with('data', $data);
    }

    public function saveSales($id = null,Request $request)
    {
        $data = $request->all();

        $sales = $this->sales->saveSales($id, $data);

        $ledger = $this->ledger->saveLedgerSales($data);

        $transaction = $this->transaction->saveTransactions($data);

        if ($sales['code'] == 422 || $ledger['code'] == 422 || $transaction['code'] == 422) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.CREATE_ERROR')
            ], 422);
        }

        $sales = $this->sales->index();

        return Redirect::to('secure/sales')->with('sales', $sales);
    }
}