<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Models\Supplier;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use Illuminate\Support\Facades\Config;
use Repo\Contracts\SupplierInterface;

class SuppliersController extends Controller
{
    private $supplier;

    public function __construct(SupplierInterface $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index()
    {
        $suppliers = $this->supplier->index();

        return view('supplier.index')->with('suppliers', $suppliers);
    }

    public function addSupplier($id = null)
    {
        if (!$id == null) {
            $suppliers = $this->supplier->index($id);

            return view('supplier.add_suppliers')->with('suppliers',$suppliers);
        }else{
            return view('supplier.add_suppliers');
        }
    }

    public function saveSupplier($id = null,Request $request)
    {
        $validationRules = [
            'supplier_code' => 'required',
            'supplier_name' => 'required',
            'supplier_email' => 'required',
            'supplier_telephone' => 'required',
            'supplier_address' => 'required',
        ];
        if (!isset($id)) {

            $validationRules['supplier_code'] = 'required|unique:' . Supplier::TABLE . ',supplier_code';
            $validationRules['supplier_email'] = 'required|unique:' . Supplier::TABLE . ',supplier_email';
            $validationRules['supplier_telephone'] = 'required|unique:' . Supplier::TABLE . ',supplier_telephone';
        }
        $this->validate($request, $validationRules);

        $suppliersStatus = $this->supplier->saveSupplier($id,$request);
        $suppliers = $suppliersStatus['result'];

        if ($suppliersStatus['status']['code'] == 200) {
            flash()->success($suppliersStatus['status']['message']);
            return Redirect::to('secure/suppliers')->with('suppliers', $suppliers);

        } elseif ($suppliersStatus['status']['code'] == 422) {
            flash()->error($suppliersStatus['status']['message']);
        }

    }
}