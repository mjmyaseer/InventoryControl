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
use Barryvdh\DomPDF\Facade as PDF;

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

    public function index(Request $request)
    {
        $userRole = $request->session()->get('role');

        if ($userRole != 1) {
            flash()->error('You are not Authorized');
            return redirect('secure/dashboard.html');
        }

        return view('reports.index');
    }

    public function saveReports(Request $request)
    {
        $data = $request->all();

        $category = $request->get('report_category');
        $keyword['start_date'] = $request->get('start_date');
        $keyword['end_date'] = $request->get('end_date');

        if (isset($data['export'])) {

            $category = $request->get('report_category');

            if ($category == 1) {
                $sales = $this->sales->index($keyword);

                $pdf = PDF::loadView('print.sales', ['sales' => $sales]);
                return $pdf->download('customer.pdf');

            } elseif ($category == 2) {
                $purchase = $this->purchase->index($keyword);

                $pdf = PDF::loadView('print.purchase', ['purchase' => $purchase]);
                return $pdf->download('customer.pdf');

            } elseif ($category == 3) {
                $salesReturns = $this->salesReturn->getSalesReturns($id = null, $keyword);
                $pdf = PDF::loadView('print.salesReturns', ['salesReturns' => $salesReturns]);
                return $pdf->download('customer.pdf');

            } elseif ($category == 4) {
                $purchaseReturns = $this->purchaseReturns->getPurchaseReturns($id = null, $keyword);
                $pdf = PDF::loadView('print.purchaseReturns', ['purchaseReturns' => $purchaseReturns]);
                return $pdf->download('customer.pdf');
            }
        } else {
            if ($category == 1) {
                $sales = $this->sales->index($keyword);
//dd($sales);
                return view('print.sales')->with('sales', $sales);
            } elseif ($category == 2) {
                $purchase = $this->purchase->index($keyword);

                return view('print.purchase')->with('purchase', $purchase);
            } elseif ($category == 3) {
                $salesReturns = $this->salesReturn->getSalesReturns($id = null, $keyword);

                return view('print.salesReturns')->with('salesReturns', $salesReturns);
            } elseif ($category == 4) {
                $purchaseReturns = $this->purchaseReturns->getPurchaseReturns($id = null, $keyword);

                return view('print.purchaseReturns')->with('purchaseReturns', $purchaseReturns);
            }
        }
    }
}