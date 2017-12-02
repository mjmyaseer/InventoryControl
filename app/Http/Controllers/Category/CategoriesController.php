<?php

namespace App\Http\Controllers\Category;

//use App\Http\Models\Category;
use App\Http\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use Repo\Contracts\CategoryInterface;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->index();

        return view('category.index')->with('categories', $categories);
    }

    public function addCategory($id = null)
    {
        $categories = $this->category->index($id);
//        dd($categories);
        return view('category.add_categories')->with('categories', $categories);
    }

    public function saveCategory($id = null, Request $request)
    {
        $validationRules = [
            'title' => 'required',
            'description' => 'required'
        ];
        if (!isset($id)) {

            $validationRules['title'] = 'required|unique:' . Category::TABLE . ',title';
        }
        $this->validate($request, $validationRules);

        if (!$request->has('title')) {
            return response()->json([
                'status' => 'FAILED',
                'error' =>Config::get('custom_messages.CAT_TITLE_REQUIRED')
            ], 200);
        }

       $categories = $this->category->saveCategory($id,$request);
        $categories = $categories['result'];

        return Redirect::to('secure/categories')->with('categories', $categories);
    }


}