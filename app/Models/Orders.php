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
        $result = DB::table('orders')->insert([
            'name' => $order['name'],
            'hasOptions' => filter_var($order['hasOptions'], FILTER_VALIDATE_BOOLEAN),
            'options' => $order['options'],
            'variants' => $order['variants'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $result;
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
        $orders = DB::table('orders')
        ->where('id', '=', $id)
        ->get();

        return $orders;
    }
}
