<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/17/2017
 * Time: 1:12 AM
 */

namespace Repo\Mysql;

use App\Http\Models\Customer;
use App\Http\Models\Item;
use App\Http\Models\SalesReturn;
use Illuminate\Support\Facades\DB;
use Repo\Contracts\SalesReturnInterface;

class SalesReturnRepo implements SalesReturnInterface
{
    private $salesReturn;

    public function __construct(SalesReturn $salesReturn)
    {
        $this->salesReturn = $salesReturn;
    }
    public function index()
    {
        return DB::table(SalesReturn::TABLE)
            ->orderBy(SalesReturn::TABLE . '.id', 'DESC')
            ->get();
    }

    public function getSalesReturns($id = null, $keyword = null)
    {
        $result = DB::table(SalesReturn::TABLE)
            ->select(SalesReturn::TABLE . '.*', Item::TABLE . '.title as item_name', Customer::TABLE . '.customer_name')
            ->leftJoin(Item::TABLE, Item::TABLE . '.id', '=', SalesReturn::TABLE . '.item_id')
            ->leftJoin(Customer::TABLE, Customer::TABLE . '.id', '=', SalesReturn::TABLE . '.customer_id');
        if ($id != null || $id != "") {
            $result->where(function ($result) use ($id) {
                $result->where(SalesReturn::TABLE . '.item_id', '=', $id);
            });
        }

        if ($keyword['start_date'] != '') {
            $result->where(SalesReturn::TABLE . '.dispatch_date', '>=', $keyword['start_date'])
                ->where(SalesReturn::TABLE . '.dispatch_date', '<=', $keyword['end_date']);

            $query = $result->orderBy(SalesReturn::TABLE . '.id', 'DESC')
                ->get();

            return $query;
        }

        $query = $result->orderBy(SalesReturn::TABLE . '.created_at', 'desc')
            ->paginate(10);

        return $query;
    }

    public function saveSalesReturn($data)
    {
        app('db')->beginTransaction();
// TODO: created by
        try {
            if (!isset($data['Sales_returns'])) {
                foreach ($data as $item) {
                    $salesReturn = new SalesReturn();

                    $salesReturn->item_id = $item['item'];
                    $salesReturn->sales_id = $item['customer_id'];
                    $salesReturn->quantity = $item['quantity'];
                    $salesReturn->dispatch_date = date("Y-m-d");
                    $salesReturn->created_by = 1;
                    $salesReturn->save();
                }
            } else {

                $salesReturn = new SalesReturn();
                $salesReturn->item_id = $data['item'];
                $salesReturn->sales_id = $data['Sales_id'];
                $salesReturn->customer_id = $data['customer_id'];
                $salesReturn->quantity = $data['quantity'];
                $salesReturn->dispatch_date = date("Y-m-d");
                $salesReturn->created_by = 1;
                $salesReturn->save();
            }

            app('db')->commit();
            return $salesReturn['status'] = [
                'status' => 'success',
                'message' => 'Successfully Saved Sales Returns',
                'code' => '200'
            ];
        } catch (\Exception $ex) {
            app('db')->rollback();
            return $salesReturn['status'] = [
                'status' => $ex->getMessage(),
                'message' => $ex->getMessage(),
                'code' => '422'
            ];
        }
    }
}