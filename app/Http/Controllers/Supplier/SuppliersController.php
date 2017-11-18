<?php

namespace App\Http\Controllers\Supplier;

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

    public function addSupplier()
    {
        return view('supplier.add_suppliers');
    }

    public function saveSupplier(Request $request)
    {
        if (!$request->has('supplier_code')) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.SUPPLIER_CODE_REQUIRED')
            ], 200);
        }

        $suppliers = $this->supplier->saveSupplier($request);
        $suppliers = $suppliers['result'];

        return view('supplier.index')->with('suppliers', $suppliers);
    }
}