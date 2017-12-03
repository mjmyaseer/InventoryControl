<?php

namespace App\Http\Controllers\Item;

use App\Http\Models\Item;
use Illuminate\Support\Facades\Redirect;
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
     * @param SupplierInterface $supplier
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

    public function addItem($id = null)
    {
        if (isset($id) && $id != null) {

            $item = $this->item->index($id);
//            dd($item);
            $categories = $this->category->index();
            $suppliers = $this->supplier->index();
            $data = array(
                'item' => $item,
                'categories' => $categories,
                'suppliers' => $suppliers
            );
        } else {
            $categories = $this->category->index();
            $suppliers = $this->supplier->index();
            $data = array(
                'categories' => $categories,
                'suppliers' => $suppliers
            );
        }

        return view('item.add_items')->with($data);
    }

    public function viewItem($id)
    {
        //$items = Item::all();
        //$items = Item::all()->sortBy("title");
        $items = Item::all()->where('id', $id);

        return view('item.view_item')->with('items', $items);
    }

    public function saveItem($id = null, Request $request)
    {

        $validationRules = [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'unit_price' => 'required',
            'max_retail_price' => 'required',
            'reorder_level' => 'required',
            'supplier_id' => 'required'
        ];
        if (!isset($id)) {
            $validationRules['title'] = 'required|unique:' . Item::TABLE . ',title';
        }

        $itemsStatus = $this->item->saveItem($id, $request);
        $items = $itemsStatus['result'];

        if ($itemsStatus['status']['code'] == 200) {
            flash()->success($itemsStatus['status']['message']);
            return Redirect::to('secure/items')->with('items', $items);

        } elseif ($itemsStatus['status']['code'] == 422) {
            flash()->error($itemsStatus['status']['message']);
        }
    }

    public function relation()
    {
        $this->item->inactiveItem();
    }
}