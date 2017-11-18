<?php

namespace App\Http\Controllers\Item;

use App\Http\Models\Item;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use \Config;
use Repo\Contracts\CategoryInterface;
use Repo\Contracts\ItemInterface;
use Repo\Contracts\SupplierInterface;

class ItemsController extends Controller
{
    private $item;

    private $category;

    private $supplier;

    /**
     * ItemsController constructor.
     * @param ItemInterface $item
     * @param CategoryInterface $category
     */
    public function __construct(ItemInterface $item,
                                CategoryInterface $category,
                                SupplierInterface $supplier)
    {
        $this->item = $item;
        $this->category = $category;
        $this->supplier = $supplier;
    }

    public function index()
    {
        $items = Item::all();
        return view('item.index')->with('items', $items);
    }

    public function addItem()
    {
        $categories = $this->category->index();
        $supplier = $this->supplier->index();
        $data = array(
            'categories'  => $categories,
            'supplier'   => $supplier
        );

        return view('item.add_items')->with($data);
    }

    public function viewItem($id)
    {
        //$items = Item::all();
        //$items = Item::all()->sortBy("title");
        $items = Item::all()->where('id', $id);

        return view('item.view_item')->with('items', $items);
    }

    public function saveItem(Request $request)
    {
//        dd($request);
        $validationRules = [
            'title' => 'required|unique:' . Item::TABLE . ',title',
            'description' => 'required',
            'category_id' => 'required',
            'unit_price' => 'required',
            'max_retail_price' => 'required',
            'quantity' => 'required',
            'reorder_level' => 'required',
            'supplier_id' => 'required'
        ];
        $this->validate($request, $validationRules);

        if (!$request->has('title')) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.ITEM_TITLE_REQUIRED')
            ], 200);
        }

        $items = $this->item->saveItem($request);
        $items = $items['result'];

        return view('item.index')->with('items', $items);
    }

    public function relation()
    {
        $this->item->inactiveItem();
    }
}