<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:52 PM
 */

namespace Repo\Mysql;

use App\Http\Models\Item;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Repo\Contracts\ItemInterface;

class ItemRepo implements ItemInterface
{
    private $item;
    protected $id = 1;
    protected $title = 1;
    protected $description = 1;
    protected $category_id = 1;
    protected $unit_price = 1;
    protected $max_retail_price = 1;
    protected $quantity = 1;
    protected $reorder_level = 1;
    protected $supplier_id = 1;
    protected $status = 1;
    protected $created_at = 1;
    protected $updated_at = 1;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function index($id = null)
    {
        $query = DB::table(Item::TABLE)
            ->select(Item::TABLE.'.id as item_id',Item::TABLE.'.title as item_title',
                Item::TABLE.'.description as item_description',Item::TABLE.'.category_id as item_category_id',
                Item::TABLE.'.unit_price as item_unit_price',Item::TABLE.'.max_retail_price as item_max_retail_price',
                Item::TABLE.'.quantity as item_quantity',Item::TABLE.'.reorder_level as item_reorder_level',
                Item::TABLE.'.supplier_id as item_supplier_id',
                Item::TABLE.'.status as item_status',Item::TABLE.'.created_at as item_created_at',
                Item::TABLE.'.updated_at as item_updated_at');
        if ($id != '') {
            $query->where(Item::TABLE . '.id', '=', $id);
        }
        $results = $query->get();

        return $results;
    }

    public function viewItem($id)
    {
        //$items = Item::all();
        //$items = Item::all()->sortBy("title");
        return $items = Item::all()->where('id', $id);
    }

    public function saveItem($id = null,$request)
    {

        try {

            if($id != null){
                $item = $this->item->where('id', $id)->first();
            }else{
                $item = new Item();
            }

            $item->title = $request->title;
            $item->description = $request->description;
            $item->category_id = $request->category_id;
            $item->unit_price = $request->unit_price;
            $item->max_retail_price = $request->max_retail_price;
            $item->reorder_level = $request->reorder_level;
            $item->supplier_id = $request->supplier_id;
            $item->status = Item::ACTIVE;
            $item->created_by = $request->session()->get('userID');

            if ($item->save()) {
                $item['status'] = [
                    'status' => 'SUCCESS',
                    'code' => 200,
                    'message' => Config::get('custom_messages.NEW_ITEM_ADDED')
                ];

                $item['result'] = Item::all();
                return $item;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $item['status'] = [
                'status' => 'FAILED',
                'code' => 422,
                'error' => Config::get('custom_messages.ERROR_WHILE_ITEM_ADDING'),
                'message' => $e->getMessage()
            ];
        }
    }

    public function inactiveItem()
    {
        $phone = Item::find(1)->Supplier();
    }


}