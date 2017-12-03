<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/14/2017
 * Time: 7:26 PM
 */

namespace Repo\Mysql;


use App\Http\Models\Customer;
use App\Http\Models\Item;
use App\Http\Models\Supplier;
use App\Http\Models\Transactions;
use Illuminate\Support\Facades\DB;
use Repo\Contracts\TransactionInterface;

class TransactionRepo implements TransactionInterface
{

    private $transaction;

    public function __construct(Transactions $transactions)
    {
        $this->transaction = $transactions;
    }

    public function index($id = null)
    {
        $result = DB::table(Transactions::TABLE)
            ->select(Transactions::TABLE.'.*',Item::TABLE.'.title as item_name',Customer::TABLE.'.customer_name',Supplier::TABLE.'.supplier_name')
            ->leftJoin(Item::TABLE,Item::TABLE.'.id','=',Transactions::TABLE.'.item_id')
            ->leftJoin(Customer::TABLE,Customer::TABLE.'.id','=',Transactions::TABLE.'.customer_id')
            ->leftJoin(Supplier::TABLE,Supplier::TABLE.'.id','=',Transactions::TABLE.'.supplier_id');
        if($id != null || $id != ""){
            $result->where(function ($result) use ($id){
                $result->where(Transactions::TABLE . '.item_id', '=', $id);
            });
        }
        $query = $result->orderBy(Transactions::TABLE . '.created_at', 'desc')
            ->paginate(10);

        return $query;
    }

    public function saveTransactions($data)
    {
        app('db')->beginTransaction();
        $referenceNumber = date("YmdHis") . rand(1, 9);

// TODO: created by
        try {
            if (isset($data['Purchase_returns'])) {
                $transaction_type = 'Purchase Returns';

                $transaction = new Transactions();
                $transaction->item_id = $data['item'];
                $transaction->supplier_id = $data['supplier_id'];
                $transaction->reference_number = $referenceNumber;
                $transaction->transaction_type = $transaction_type;
                $transaction->quantity = $data['quantity'];
                $transaction->transaction_date = date("H-m-d");
                $transaction->created_by = 1;
                $transaction->save();

            }elseif(isset($data['Sales_returns']))
            {
                $transaction_type = 'Sales Returns';

                $transaction = new Transactions();
                $transaction->item_id = $data['item'];
                $transaction->customer_id = $data['customer_id'];
                $transaction->reference_number = $referenceNumber;
                $transaction->transaction_type = $transaction_type;
                $transaction->quantity = $data['quantity'];
                $transaction->transaction_date = date("H-m-d");
                $transaction->created_by = 1;
                $transaction->save();
            }
            else{

                foreach ($data['order'] as $item) {

                    $transaction = new Transactions();

                    if (isset($data['customer_id']) || !empty($data['customer_id'])) {
                        $transaction->customer_id = $data['customer_id'];
                        $transaction_type = 'Sales';
                    } elseif (isset($data['supplier_id']) || !empty($data['supplier_id'])) {
                        $transaction->supplier_id = $data['supplier_id'];
                        $transaction_type = 'Purchases';
                    }

                    $transaction->item_id = $item['item'];
                    $transaction->reference_number = $referenceNumber;
                    $transaction->transaction_type = $transaction_type;
                    $transaction->quantity = $item['quantity'];
                    $transaction->transaction_date = date("H-m-d");
                    $transaction->created_by = 1;
                    $transaction->save();
                }
            }

            app('db')->commit();
            return $transaction['status'] = [
                'status' => 'success',
                'message' => 'Successfully Saved Transaction',
                'code' => '200'
            ];
        } catch (\Exception $ex) {
            app('db')->rollback();
            return $transaction['status'] = [
                'status' => $ex->getMessage(),
                'message' => $ex->getMessage(),
                'code' => '422'
            ];
        }
    }
}