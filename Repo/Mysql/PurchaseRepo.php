<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/5/2017
 * Time: 10:01 PM
 */

namespace Repo\Mysql;

use App\Http\Models\Purchase;
use App\Http\Models\Item;
use App\Http\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Repo\Contracts\PurchaseInterface;

class PurchaseRepo implements PurchaseInterface
{
    // Created to generate the ER Diagram
    protected $id = 1;
    protected $grn_detail = 1;
    protected $grn_id = 1;
    protected $grn_no = 1;
    protected $reference_no = 1;
    protected $supplier_id = 1;
    protected $supplier_description = 1;
    protected $created_at = 1;
    protected $updated_at = 1;

    private $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function index($keyword = null)
    {
        $query = DB::table(Purchase::TABLE)
            ->select(Purchase::TABLE.'.*',Item::TABLE.'.*',Supplier::TABLE.'.*',
                Supplier::TABLE.'.id as supplier_id',Purchase::TABLE.'.quantity as total',Purchase::TABLE.'.id as id',
                Item::TABLE.'.id as item_id',Purchase::TABLE.'.created_at as created_at',
                Purchase::TABLE.'.updated_at as updated_at',Purchase::TABLE.'.status as status')
            ->leftJoin(Item::TABLE, Item::TABLE . '.id', '=', Purchase::TABLE . '.item_id')
            ->leftJoin(Supplier::TABLE, Supplier::TABLE . '.id', '=', Purchase::TABLE . '.supplier_id');

            if ($keyword['start_date'] != '') {
                $query->where(Purchase::TABLE . '.order_date', '>=', $keyword['start_date'])
                    ->where(Purchase::TABLE . '.order_date', '<=', $keyword['end_date']);

                $results = $query->orderBy(Purchase::TABLE . '.id', 'DESC')
                    ->get();

                return $results;
            }

        $results = $query->orderBy(Purchase::TABLE . '.id', 'DESC')
            ->paginate(10);

            return $results;
    }

    public function getIndividualPurchase($id)
    {

    }

    public function savePurchases($data)
    {
        app('db')->beginTransaction();

        try {
            foreach ($data['order'] as $item) {
                $grn = new Purchase();
                $grn->supplier_id = $data['supplier_id'];
                $grn->category_id = $item['category'];
                $grn->item_id = $item['item'];
                $grn->quantity = $item['quantity'];
                $grn->status = 1;
                $grn->order_date = date("Y-m-d H:i:s",strtotime($data['order_date']));
                $grn->save();
            }

            app('db')->commit();

            return [
                'status' => 'success',
                'code' => '200'

            ];

        } catch (\Exception $ex) {

            app('db')->rollback();

            return [
                'status' => $ex->getMessage(),
                'code' => '422'
            ];
        }
    }

    public function purchaseReturnStatus($id)
    {
        app('db')->beginTransaction();

        try {
        $purchase = $this->purchase->find($id);
        $purchase->status = 2;
        $purchase->save();

            app('db')->commit();

            return [
                'status' => 'success',
                'code' => '200'

            ];

        } catch (\Exception $ex) {

            app('db')->rollback();

            return [
                'status' => $ex->getMessage(),
                'code' => '422'
            ];
        }
    }
}