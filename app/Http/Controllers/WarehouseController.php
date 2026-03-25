<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WareHouse;
class WarehouseController extends Controller
{
    public function index()
    {
        $stock = WareHouse::with('items:id,name,catogory_id')->get();
        return view('warehouse.index', compact('stock'));
    }   
}
