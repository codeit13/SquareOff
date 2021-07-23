<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function admin(Request $request) 
    {   $id = $request->route('id');
        
        return view('admin')->with('id', $id);
    }

    public static function saveOrder(Request $request)
    {
        $input = $request->all();
        Orders::saveOrder([
            'name' => $request->name,
            'hasOptions' => $request->hasOptions,
            'options' => json_encode($request->options),
            'variants' => json_encode($request->variants),
        ]);

        return response()->json(['success' => 'Your Order have been saved successfully.']);
    }

    public static function updateOrder(Request $request)
    {
        $input = $request->all();
        Orders::updateOrder([
            'id' => $request->id,
            'name' => $request->name,
            'hasOptions' => $request->hasOptions,
            'options' => json_encode($request->options),
            'variants' => json_encode($request->variants),
        ]);

        return response()->json(['success' => 'Your Order have been updated successfully.']);
    }

    public static function getOrders(Request $request)
    {
        $rows = Orders::getOrders($request->id);

        $orders = array();
        $temp = array();

        foreach ($rows as $key => $row) {
            $temp['name'] = $row->name;
            $temp['hasOptions'] = $row->hasOptions;
            $temp['options'] = json_decode($row->options, true);
            $temp['variants'] = json_decode($row->variants, true);

            array_push($orders, $temp);
        }

        return response()->json($orders);
    }
}
