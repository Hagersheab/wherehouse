<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $items = Item::where('name', 'like', "%$search%")
                ->get();
        }
        else {
            $items = Item::all();
        }
        return view('item.index')->with('items', $items)->with('success', 'تم البحث بنجاح');

    }

    public function create()
    {
        $categories = Category::all();
        return view('item.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'catogory_id' => 'required',
        ]);
        $item = Item::create($request->all());
        return redirect()->route('items.index');
    }
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('item.edit', compact('item', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'catogory_id' => 'required',
        ]);
        $item = Item::find($id);
        $item->update($request->all());
        return redirect()->route('items.index');
    }
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('items.index');
    }


}
