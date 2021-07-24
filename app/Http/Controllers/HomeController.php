<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{   
    public function storeImage(Request $request)
    {
        $id = $request->id;
        $request->validate([
          'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500000',
        ]);

        if ($request->file('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
        }

        $imagePath = '/storage/'.$path;
        Orders::updateImageData($id, $imageName, $imagePath);

        return response()->json('Image uploaded successfully');
    }

    public function admin(Request $request) 
    {   $rows = Orders::getOrders('__ALL__');

        $orders = array();

        foreach ($rows as $key => $row) {
            array_push($orders, (array)$row);
        }
        
        return view('admin')->with('orders', $orders);
    }

    public function orderEdit(Request $request) 
    {   $id = $request->route('id');
        $result = Orders::getImagePath($id);

        $name = $result['name'];
        $mrp = $result['mrp'];
        $image_path = $result['image_path'];
        
        return view('order-edit')->with(compact('id', 'name', 'mrp', 'image_path'));
    }

    public static function saveOrder(Request $request)
    {
        $input = $request->all();
        $id = Orders::saveOrder([
            'name' => $request->name,
            'mrp' => $request->mrp,
            'hasOptions' => $request->hasOptions,
            'options' => json_encode($request->options),
            'variants' => json_encode($request->variants),
        ]);

        return response()->json([
            'success' => 'Your Order have been saved successfully.',
            'id' => $id
        ]);
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
