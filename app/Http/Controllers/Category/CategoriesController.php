<?php

namespace App\Http\Controllers\Category;

//use App\Http\Models\Category;
use App\Http\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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
        if (!$id == null) {
            $categories = $this->category->index($id);

            return view('category.add_categories')->with('categories', $categories);
        } else {
            return view('category.add_categories');
        }
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

        $categoriesStatus = $this->category->saveCategory($id, $request);

        $categories = $categoriesStatus['result'];

        if ($categoriesStatus['status']['code'] == 200) {
            flash()->success($categoriesStatus['status']['message']);
            return Redirect::to('secure/categories')->with('categories', $categories);

        } elseif ($categoriesStatus['status']['code'] == 422) {
            flash()->error($categoriesStatus['status']['message']);
        }

    }


}