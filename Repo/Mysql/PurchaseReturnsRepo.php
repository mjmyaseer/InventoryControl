<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 11/14/2017
 * Time: 11:21 PM
 */

namespace Repo\Mysql;

use App\Http\Models\Customer;
use App\Http\Models\Item;
use App\Http\Models\PurchaseReturn;
use App\Http\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Repo\Contracts\PurchaseReturnsInterface;

class PurchaseReturnsRepo implements PurchaseReturnsInterface
{
    private $purchase;
    // Created to generate the ER Diagram

    protected $id = 1;
    protected $purchase_id = 1;
    protected $item_id = 1;
    protected $supplier_id = 1;
    protected $quantity = 1;
    protected $order_date = 1;
    protected $created_by = 1;
    protected $updated_at = 1;


    public function __construct(PurchaseReturn $purchaseReturn)
    {
        $this->purchase = $purchaseReturn;
    }

    public function index()
    {
        return DB::table(PurchaseReturn::TABLE)
            ->orderBy(PurchaseReturn::TABLE . '.id', 'DESC')
            ->get();
    }

    public function getPurchaseReturns($id = null,$keyword = null)
    {
        $result = DB::table(PurchaseReturn::TABLE)
            ->select(PurchaseReturn::TABLE . '.*', Item::TABLE . '.title as item_name', Supplier::TABLE . '.supplier_name')
            ->leftJoin(Item::TABLE, Item::TABLE . '.id', '=', PurchaseReturn::TABLE . '.item_id')
            ->leftJoin(Supplier::TABLE, Supplier::TABLE . '.id', '=', PurchaseReturn::TABLE . '.supplier_id');
        if ($id != null || $id != "") {
            $result->where(function ($result) use ($id) {
                $result->where(PurchaseReturn::TABLE . '.item_id', '=', $id);
            });
        }

        if ($keyword['start_date'] != '') {
            $result->where(PurchaseReturn::TABLE . '.order_date', '>=', $keyword['start_date'])
                ->where(PurchaseReturn::TABLE . '.order_date', '<=', $keyword['end_date']);

            $query = $result->orderBy(PurchaseReturn::TABLE . '.id', 'DESC')
                ->get();

            return $query;
        }

        $query = $result->orderBy(PurchaseReturn::TABLE . '.created_at', 'desc')
            ->paginate(10);

        return $query;
    }

    public function savePurchaseReturn($data)
    {
        app('db')->beginTransaction();
// TODO: created by
        try {
            if (!isset($data['Purchase_returns'])) {
                foreach ($data as $item) {
                    $purchaseReturn = new PurchaseReturn();

                    $purchaseReturn->item_id = $item['item'];
                    $purchaseReturn->supplier_id = $item['supplier_id'];
                    $purchaseReturn->quantity = $item['quantity'];
                    $purchaseReturn->order_date = date("Y-m-d");
                    $purchaseReturn->created_by = 1;
                    $purchaseReturn->save();
                }
            } else {

                $purchaseReturn = new PurchaseReturn();
                $purchaseReturn->item_id = $data['item'];
                $purchaseReturn->Purchase_id = $data['Purchase_id'];
                $purchaseReturn->supplier_id = $data['supplier_id'];
                $purchaseReturn->quantity = $data['quantity'];
                $purchaseReturn->order_date = date("Y-m-d");
                $purchaseReturn->created_by = 1;
                $purchaseReturn->save();
            }

            app('db')->commit();
            return $purchaseReturn['status'] = [
                'status' => 'success',
                'message' => 'Successfully Saved Purchase Returns',
                'code' => '200'
            ];
        } catch (\Exception $ex) {
            app('db')->rollback();
            return $purchaseReturn['status'] = [
                'status' => $ex->getMessage(),
                'msg' => $ex->getMessage(),
                'code' => '422'
            ];
        }
    }
}