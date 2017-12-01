<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Models\Supplier;
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
//        dd($suppliers);
        return view('supplier.index')->with('suppliers', $suppliers);
    }

    public function addSupplier($id = null)
    {
        $suppliers = $this->supplier->index($id);

        return view('supplier.add_suppliers')->with('suppliers',$suppliers);
    }

    public function saveSupplier($id = null,Request $request)
    {
        $validationRules = [
            'item_id' => 'required',
            'supplier_code' => 'required',
            'supplier_name' => 'required',
            'supplier_email' => 'required',
            'supplier_telephone' => 'required',
            'supplier_address' => 'required',
            'customer_address' => 'required'
        ];
        if (!isset($id)) {

            $validationRules['supplier_code'] = 'required|unique:' . Supplier::TABLE . ',title';
            $validationRules['supplier_email'] = 'required|unique:' . Supplier::TABLE . ',title';
            $validationRules['supplier_telephone'] = 'required|unique:' . Supplier::TABLE . ',title';
        }
        $this->validate($request, $validationRules);


        if (!$request->has('supplier_code')) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.SUPPLIER_CODE_REQUIRED')
            ], 200);
        }

        $suppliers = $this->supplier->saveSupplier($id,$request);
        $suppliers = $suppliers['result'];

        return Redirect::to('secure/suppliers')->with('suppliers', $suppliers);
    }
}