<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:52 PM
 */

namespace repo\Mysql;

use App\Http\Models\Customer;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Repo\Contracts\CustomerInterface;

class CustomerRepo implements CustomerInterface
{
    private $customer;
    protected $id = 1;
    protected $items_id = 1;
    protected $customer_code = 1;
    protected $customer_name = 1;
    protected $customer_email = 1;
    protected $customer_telephone = 1;
    protected $customer_address = 1;
    protected $created_at = 1;
    protected $updated_at = 1;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function index($id = null)
    {
        $query = DB::table(Customer::TABLE)
            ->select(Customer::TABLE.'.id as customer_id',Customer::TABLE.'.customer_code as customer_code',
                Customer::TABLE.'.customer_name as customer_name',Customer::TABLE.'.customer_email as customer_email',
                Customer::TABLE.'.customer_telephone as customer_telephone',
                Customer::TABLE.'.customer_address as customer_address',
                Customer::TABLE.'.created_at as supplier_created_at',
                Customer::TABLE.'.updated_at as supplier_updated_at');
        if ($id != '') {
            $query->where(Customer::TABLE . '.id', '=', $id);
        }
        $results = $query->get();

        return $results;
    }

    public function saveCustomer($id = null,$request)
    {
        try {
            if($id != null){
                $customer = $this->customer->where('id', $id)->first();
            }else{
                $customer = new Customer();
            }

            $customer->customer_code = $request->customer_code;
            $customer->customer_name = $request->customer_name;
            $customer->customer_email = $request->customer_email;
            $customer->customer_telephone = $request->customer_telephone;
            $customer->customer_address = $request->customer_address;

            if ($customer->save()) {
                $customer['status'] = response()->json([
                    'status' => 'SUCCESS',
                    'message' => Config::get('custom_messages.NEW_CUSTOMER_ADDED')
                ], 200);

                $customer['result'] = Customer::all();;
                return $customer;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $customer['status'] = response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.ERROR_WHILE_CUSTOMER_ADDING')
            ], 200);
        }
    }
}