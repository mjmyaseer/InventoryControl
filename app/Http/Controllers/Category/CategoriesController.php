<?php

namespace App\Http\Controllers\Category;

//use App\Http\Models\Category;
use Illuminate\Support\Facades\Config;
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

    public function addCategory()
    {
        $categories = $this->category->index();
        return view('category.add_categories')->with('categories', $categories);
    }

    public function saveCategory(Request $request)
    {
        if (!$request->has('title')) {
            return response()->json([
                'status' => 'FAILED',
                'error' =>Config::get('custom_messages.CAT_TITLE_REQUIRED')
            ], 200);
        }

       $categories = $this->category->saveCategory($request);
        $categories = $categories['result'];

        return view('category.index')->with('categories', $categories);
    }
}