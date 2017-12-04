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
use Illuminate\Support\Facades\DB;
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

    public function index($id = null)
    {
            $query = DB::table(Category::TABLE)
                ->select(Category::TABLE.'.id as category_id',Category::TABLE.'.title as category_title',
                    Category::TABLE.'.description as category_description',
                    Category::TABLE.'.status as category_status',Category::TABLE.'.created_at as category_created_at',
                    Category::TABLE.'.updated_at as category_updated_at');
            if ($id != '') {
                $query->where(Category::TABLE . '.id', '=', $id);
            }
            $results = $query->get();

            return $results;

//        if($id != null)
//        {
//            return $this->category->where('id', $id)->first();
//        }else{
//            return $categories = Category::all();
//        }

    }

    public function addCategory()
    {
        return view('category.add_categories');
    }

    public function saveCategory($id = null,$request)
    {
        try {
            if($id != null){
                $category = $this->category->where('id', $id)->first();
            }else{
                $category = new Category();
            }

            $category->title = $request->title;
            $category->description = $request->description;
            $category->status = Category::ACTIVE;
            $category->created_by = $request->session()->get('userID');

            if ($category->save()) {
                $categories['status'] = [
                    'status' => 'SUCCESS',
                    'code' => 200,
                    'message' => Config::get('custom_messages.NEW_CAT_ADDED')
                ];

                $categories['result'] = Category::all();;
                return $categories;

            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $categories['status'] = [
                'status' => 'FAILED',
                'code' => 422,
                'error' => Config::get('custom_messages.ERROR_WHILE_CAT_ADDING'),
                'message' => $e->getMessage()
            ];
        }
    }

    public function inactiveCategory()
    {
        
    }
}