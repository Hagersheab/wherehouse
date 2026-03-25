<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Import;
use App\Models\Item;
use App\Models\Warehouse;

class ImportController extends Controller
{
    public function index()
    {
        //with تستخدم للحصول على البيانات المرتبطة بالمستخدم
        //items هي العلاقة بين المستخدم والمنتجات
        //aprovet_by هي العلاقة بين المستخدم والموظف الموافق على الاستيراد  
        $imports = Import::with('items','aprovet_by')->get();
        return view('imports.index', compact('imports'));
    }
    //create هي الصفحة التي تستخدم لإضافة المنتجات إلى الاستيراد
    public function create()
    {
        $items = Item::with('category')->get();
        return view('imports.create', compact('items'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
        $import = Import::create([
            'date' => $request->date,
            'status' => 'pending',
        
        ]);
        foreach ($request->items as $item) {
            $import->items()->attach($item['item_id'], ['quantity' => $item['quantity']]);
        }
      
        return redirect()->route('imports.index')->with('success', __('Import invoice created.confirm it to add stock to warehouse'));
    }
    public function show(import $import)
    {
        $import->load('items','aprovet_by');
        // dd($import);
        return view('imports.show', compact('import'));
    }
    public function conferm(Import $import)
    {
       // dd($import);
        if ($import->status !== Import::STATUS_PENDING) {
           // dd($import->status);
            return redirect()->route('imports.index')->with('error', __('Import invoice is not pending'));
        }
        foreach ($import->items as $item) {
            $qty=(int)$item->pivot->quantity;
            warehouse::create([
                'item_id' => $item->id,
                'quantity' => $qty,
                'expired_date' => null,
            ]);

        }
        $import->update([
            'status' => Import::STATUS_CONFIRMED,
            'aprovet_by_id' => auth()->user()->id,
        ]);
        return redirect()->route('imports.index')->with('success', __('Import invoice confirmed.stock added to warehouse'));
    }
}
