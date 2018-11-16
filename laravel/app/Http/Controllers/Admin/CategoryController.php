<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories=Category::all();
        //dd($categories);
        $categories=Category::paginate(5);
        return view('admin.category.index',compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(CategoryRequest $request)
    {
       // dd($request->all());
        Category::create($request->all());
        return redirect()->route('admin.category.index')->with('success','操作成功');
    }

    public function edit(Category $category)
    {
//            dd($category);
        return view('admin.category.edit',compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
       // dd($category);
        $category->update($request->all());

        return redirect()->route('admin.category.index')->with('success','操作成功');
    }

    public function destroy(Category $category)
    {
        //dd($category);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success','操作成功');
    }
}
