<?php

namespace App\Http\Controllers\Customer;

use App\Http\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use Illuminate\Support\Facades\Config;
use Repo\Contracts\CustomerInterface;

class CustomersController extends Controller
{
    private $customer;

    public function __construct(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }

    public function index()
    {
        $customers = $this->customer->index();

        return view('customer.index')->with('customers', $customers);
    }

    public function addCustomer($id = null)
    {
        if (!$id == null) {
            $customers = $this->customer->index($id);

            return view('customer.add_customers')->with('customers', $customers);
        }else{
            return view('customer.add_customers');
        }

    }

    public function saveCustomer($id = null, Request $request)
    {
        $validationRules = [
            'customer_code' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_telephone' => 'required',
            'customer_address' => 'required'
        ];
        if (!isset($id)) {

            $validationRules['customer_code'] = 'required|unique:' . Customer::TABLE . ',customer_code';
            $validationRules['customer_email'] = 'required|unique:' . Customer::TABLE . ',customer_email';
            $validationRules['customer_telephone'] = 'required|unique:' . Customer::TABLE . ',customer_telephone';
        }
        $this->validate($request, $validationRules);

        if (!$request->has('customer_code')) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.CUSTOMER_CODE_REQUIRED')
            ], 200);
        }

        $customers = $this->customer->saveCustomer($id, $request);
        $customers = $customers['result'];

        return Redirect::to('secure/customers')->with('customers', $customers);
    }
}