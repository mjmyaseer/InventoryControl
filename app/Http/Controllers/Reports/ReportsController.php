<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/17/2017
 * Time: 3:23 PM
 */

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Repo\Contracts\PurchaseInterface;
use Repo\Contracts\PurchaseReturnsInterface;
use Repo\Contracts\SalesInterface;
use Repo\Contracts\SalesReturnInterface;

class ReportsController extends Controller
{
    private $purchase;
    private $sales;
    private $purchaseReturns;
    private $salesReturn;

    public function __construct(PurchaseInterface $purchase,
                                SalesInterface $sales,
                                PurchaseReturnsInterface $purchaseReturns,
                                SalesReturnInterface $salesReturn)
    {
        $this->purchase = $purchase;
        $this->sales = $sales;
        $this->purchaseReturns = $purchaseReturns;
        $this->salesReturn = $salesReturn;
    }

    public function index()
    {
        return view('reports.index');
    }

    public function saveReports(Request $request)
    {
        $data = $request->all();
        $category = $request->get('report_category');

        $keyword['start_date'] = $request->get('start_date');
        $keyword['end_date'] = $request->get('end_date');

        if ($category == 1) {
            $sales = $this->sales->index($keyword);
            dd($sales);
            return view('print.printPDF');
        } elseif ($category == 2) {
            $purchase = $this->purchase->index($keyword);
            dd($purchase);
            return view('print.printPDF');
        } elseif ($category == 3) {
            $salesReturns = $this->salesReturn->getSalesReturns($id = null, $keyword);
            dd($salesReturns);
            return view('print.printPDF');
        } elseif ($category == 4) {
            $purchaseReturns = $this->purchaseReturns->getPurchaseReturns($id = null, $keyword);
            dd($purchaseReturns);
            return view('print.printPDF');
        }


    }
}