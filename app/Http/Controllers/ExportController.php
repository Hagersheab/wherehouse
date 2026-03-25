<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Export;
use App\Models\Department;
use App\Models\User;
use App\Models\Item;
use App\Models\WareHouse;
class ExportController extends Controller
{
    //
    public function index()
    {
        $exports = Export::with('department', 'reseved_by', 'approved_by')->get();
        return view('exports.index', compact('exports'));
    }
    public function create()
    // {
    //     $departments = Department::all();
    //     $users = User::where('department_id', $department->id)->get();
    //     return view('exports.create', compact('departments', 'users'));
    // }
    {
        $departments = Department::all();
        $users = User::all(); // جلب كل المستخدمين بدلاً من الفلترة بقسم غير موجود
        $items = Item::all();
        return view('exports.create', compact('departments', 'users', 'items'));
    }
    public function store(Request $request)
    {
    
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'reseved_by_id' => 'required|exists:users,id',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        
        ]);

        $export = Export::create([
            'department_id' => $request->department_id,
            'reseved_by_id' => $request->rereseved_by_id,
            'date_approve' => now(),
            'status' => 'pending',
        ]);
        foreach ($request->items as $item) {
            $export->items()->attach($item['item_id'], ['quantity' => $item['quantity']]);
        }
        return redirect()->route('exports.index')->with('success', __('Import invoice created.confirm it to add stock to warehouse'));
    }
    public function show(Export $export)
    {
        $export->load('department','reseved_by','approved_by','items.category');
        return view('exports.show',compact('export'));
    }

    public function deliver(Export $export)
    {
        if ($export->status !== Export::STATUS_PENDING )
        {
            return redirect()->route('exports.show',$export)->with('error',',هدا الصنف لا يتوفر او الكمية ليشت كافية ');
        }
        //التحقق منتوفر الكمية
        foreach ($export->items as $item)
        {
            $needed =(int) $item->pivot->quantity;
            $available = WareHouse::where('item_id',$item->id )->sum('quantity');
            if($available < $needed){
                return redirect ()->route('exports.show',$export)->with('error',  'الكمية ليشت كافية ');
            }
        }

//خصم الكمية من المخزن
        foreach ($export->items as $item) {
            $remainig = (int) $item->pivot->quantity;
            $rows = \App\Models\WareHouse::where('item_id', '=', $item->id)->orderBy('id')->get();

            //المرور على سجل كل المخزن
            foreach ($rows as $row) {
                if ($remainig <= 0) {
                    break;
                }
                $deduct = min($remainig, $row->quantity);
                $row->decrement('quantity', $deduct);
                $remainig -= $deduct;
                if ($row->quantity <= 0) {
                    $row->delete();
                }
            }
        }
//المرور على سجل كل المخزن

    $export->update([
        'status'=>Export::STATUS_CONFIRMED,
        'approved_by_id'=>auth()->id(),
        'date_approve'=> now(),
    ]);
    return redirect ()->route('exports.show',$export)->with('success',  'تمت العملية بنجاح ');
    }
}
