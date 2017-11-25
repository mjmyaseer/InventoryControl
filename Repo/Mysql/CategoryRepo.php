<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 9/2/2017
 * Time: 1:53 PM
 */

namespace Repo\Mysql;

use App\Http\Models\Category;
use Illuminate\Support\Facades\Config;
use Repo\Contracts\CategoryInterface;

class CategoryRepo implements CategoryInterface
{
    private $category;
    protected $items_id = 1;
    protected $title = 1;
    protected $description = 1;
    protected $parent_id = 1;
    protected $status = 1;
    protected $created_at = 1;
    protected $updated_at = 1;
    protected $categories_id = 1;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $categories = Category::all();
    }

    public function addCategory()
    {
        return view('category.add_categories');
    }

    public function saveCategory($request)
    {
        if (!$request->has('title')) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.CAT_TITLE_REQUIRED')
            ], 200);
        }
        try {
            $category = new Category();
            $category->title = $request->title;
            $category->description = $request->description;
            $category->parent_id = $request->parent_id;
            $category->status = Category::ACTIVE;

            if ($category->save()) {
                $categories['status'] = response()->json([
                    'status' => 'SUCCESS',
                    'message' => Config::get('custom_messages.NEW_CAT_ADDED')
                ], 200);

                $categories['result'] = Category::all();;
                return $categories;

            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $categories['status'] = response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.ERROR_WHILE_CAT_ADDING')
            ], 200);
        }
    }

    public function inactiveCategory()
    {
        
    }
}