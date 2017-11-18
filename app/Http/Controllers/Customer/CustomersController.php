<?php
namespace App\Http\Controllers\Customer;
use App\Http\Models\Customer;
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

        return view('customer.index')->with('customers',$customers);
    }

    public function addCustomer(){
        return view('customer.add_customers');
    }

    public function saveCustomer(Request $request){

        if(!$request->has('customer_code')){
            return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.CUSTOMER_CODE_REQUIRED')
            ],200);
        }

        $customers = $this->customer->saveCustomer($request);
        $customers = $customers['result'];

        return view('customer.index')->with('customers', $customers);
    }
}