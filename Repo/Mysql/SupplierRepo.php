<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:52 PM
 */

namespace Repo\Mysql;

use App\Http\Models\Supplier;
use Illuminate\Support\Facades\Config;
use Repo\Contracts\SupplierInterface;

class SupplierRepo implements SupplierInterface
{
    private $supplier;
    protected $supplier_code = 2;
    protected $supplier_name = 1;
    protected $categories_id= 1;
    protected $supplier_telephone = 1;
    protected $supplier_address = 1;
    protected $created_at = 1;
    protected $updated_at= 1;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index()
    {
        return Supplier::all();
    }

    public function saveSupplier($request)
    {
        try {
            $supplier = new Supplier();
            $supplier->supplier_code = $request->supplier_code;
            $supplier->supplier_name = $request->supplier_name;
            $supplier->supplier_telephone = $request->supplier_telephone;
            $supplier->supplier_address = $request->supplier_address;

            if ($supplier->save()) {
                $suppliers['status'] = response()->json([
                    'status' => 'SUCCESS',
                    'message' => Config::get('custom_messages.NEW_SUPPLIER_ADDED')
                ], 200);

                $suppliers['result'] = $supplier::all();
                return $suppliers;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $suppliers['status'] = response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.ERROR_WHILE_SUPPLIER_ADDING')
            ], 200);
        }
    }

    public function inactiveSupplier()
    {
        
    }
}