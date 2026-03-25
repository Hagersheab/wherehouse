<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $categories = Category::where('name', 'like', "%$search%")
                ->get();
        }
        else {
            $categories = Category::all();
        }
        return view('category.index')->with('categories', $categories)->with('success', 'تم البحث بنجاح');

    }

    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index');
    }

}