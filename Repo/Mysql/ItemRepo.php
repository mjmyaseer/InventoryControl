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

    public function index()
    {
        return $items = Item::all();
    }

    public function viewItem($id)
    {
        //$items = Item::all();
        //$items = Item::all()->sortBy("title");
        return $items = Item::all()->where('id', $id);
    }

    public function saveItem($request)
    {
        try {
            $item = new Item();
            $item->title = $request->title;
            $item->description = $request->description;
            $item->category_id = $request->category_id;
            $item->unit_price = $request->unit_price;
            $item->max_retail_price = $request->max_retail_price;
            $item->quantity = $request->quantity;
            $item->reorder_level = $request->reorder_level;
            $item->supplier_id = $request->supplier_id;
            $item->status = Item::ACTIVE;

            if ($item->save()) {
                $item['status'] = response()->json([
                    'status' => 'SUCCESS',
                    'message' => Config::get('custom_messages.NEW_ITEM_ADDED')
                ], 200);

                $item['result'] = Item::all();
                return $item;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $item['status'] = response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.ERROR_WHILE_ITEM_ADDING')
            ], 200);
        }
    }

    public function inactiveItem()
    {
        $phone = Item::find(1)->Supplier();
    }


}