<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Orders extends Model
{
    use HasFactory;

    public static function saveOrder($order)
    {
        $id = DB::table('orders')->insertGetId([
            'name' => $order['name'],
            'mrp' => $order['mrp'],
            'hasOptions' => filter_var($order['hasOptions'], FILTER_VALIDATE_BOOLEAN),
            'options' => $order['options'],
            'variants' => $order['variants'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Log::debug($id);

        return $id;
    }

    public static function updateOrder($order)
    {
        $result = DB::table('orders')
        ->where('id', $order['id'])
        ->update([
            'variants' => $order['variants'],
            'updated_at' => now()
        ]);

        return $result;
    }

    public static function getOrders($id) {
        if($id == '__ALL__') {
            $orders = DB::select('select * from orders');
        } else {
            $orders = DB::table('orders')
                ->where('id', '=', $id)
                ->get();
        }

        return $orders;
    }

    public static function getImagePath($id) {
        $result = DB::select('select name, mrp, image_path from orders where id=?', [$id]);
        $image_path = $result[0]->image_path;
        $name = $result[0]->name;
        $mrp = $result[0]->mrp;
        return [
            'name' => $name,
            'mrp' => $mrp,
            'image_path' => $image_path
        ];
    }

    public static function updateImageData($id, $imageName, $imagePath) {
        
        $result = DB::update('update orders set image_name = ? , image_path = ? where id = ?', [$imageName, $imagePath, $id]);

        return $result;
    }
}
