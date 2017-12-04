<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/5/2017
 * Time: 10:01 PM
 */

namespace Repo\Mysql;

use App\Http\Models\Category;
use App\Http\Models\Customer;
use App\Http\Models\Sales;
use App\Http\Models\Item;
use Illuminate\Support\Facades\DB;
use Repo\Contracts\SalesInterface;

class SalesRepo implements SalesInterface
{
    private $sales;

    public function __construct(Sales $sales)
    {
        $this->sales = $sales;
    }

    public function index($keyword = null)
    {
        $query = DB::table(Sales::TABLE)
            ->select(Sales::TABLE . '.*', Item::TABLE . '.*', Customer::TABLE . '.*', Sales::TABLE . '.quantity as quantity',
                Customer::TABLE . '.id as customer_id', Sales::TABLE . '.id as id', Item::TABLE . '.id as item_id',
                Sales::TABLE . '.created_at as created_at', Sales::TABLE . '.updated_at as updated_at',
                Sales::TABLE . '.status as status', Sales::TABLE . '.quantity as sales_quantity',
                DB::raw("(SELECT SUM((" . Item::TABLE . ".max_retail_price - " . Item::TABLE . ".unit_price)* 
                        " . Item::TABLE . ".quantity) FROM " . Item::TABLE . ") as total"))
            ->leftJoin(Item::TABLE, Item::TABLE . '.id', '=', Sales::TABLE . '.item_id')
            ->leftJoin(Customer::TABLE, Customer::TABLE . '.id', '=', Sales::TABLE . '.customer_id');

        if ($keyword['start_date'] != '') {

            $query->where(Sales::TABLE . '.dispatch_date', '>=', $keyword['start_date'])
                ->where(Sales::TABLE . '.dispatch_date', '<=', $keyword['end_date'])
                ->where(Sales::TABLE . '.status', '=', 1);

            $results = $query->orderBy(Sales::TABLE . '.id', 'DESC')
                ->get();

            return $results;
        }

        $results = $query->orderBy(Sales::TABLE . '.id', 'DESC')
            ->paginate(10);
        return $results;
    }

    public function getSales()
    {

    }

    public function saveSales($id = null, $data, $request)
    {
        app('db')->beginTransaction();

        try {
            foreach ($data['order'] as $item) {
                if ($id != null) {
                    $sales = $this->sales->where('id', $id)->first();
                } else {
                    $sales = new Sales;
                }

                $sales->customer_id = $data['customer_id'];
                $sales->category_id = $item['category'];
                $sales->item_id = $item['item'];
                $sales->quantity = $item['quantity'];
                $sales->dispatch_date = date("Y-m-d H:i:s", strtotime($data['dispatch_date']));
                $sales->created_by = $request->session()->get('userID');
                $sales->save();
            }

            app('db')->commit();

            return $sales['status'] = [
                'status' => 'success',
                'message' => 'Successfully Saved Sales',
                'code' => '200'

            ];

        } catch (\Exception $ex) {

            app('db')->rollback();

            return $sales['status'] = [
                'status' => $ex->getMessage(),
                'message' => $ex->getMessage(),
                'code' => '422'
            ];
        }
    }

    public function salesReturnStatus($id)
    {
        app('db')->beginTransaction();

        try {
            $sales = $this->sales->find($id);
            $sales->status = 2;
            $sales->save();

            app('db')->commit();

            return $sales['status'] = [
                'status' => 'success',
                'message' => 'Successfully Saved Sales Returns',
                'code' => '200'

            ];

        } catch (\Exception $ex) {

            app('db')->rollback();

            return $sales['status'] =  [
                'status' => $ex->getMessage(),
                'message' => $ex->getMessage(),
                'code' => '422'
            ];
        }
    }
}