<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function create()
    {
        return view('orders.input');
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email:rfc,dns',
            'order' => 'required|string'
                                        ]);

        $result = json_encode([
                                  'name' => $validated['name'],
                                  'phone' => $validated['phone'],
                                  'email' => $validated['email'],
                                  'order' => $validated['order'],
                              ], JSON_PRETTY_PRINT);
        $fileName = 'order_' . time() . '_' . uniqid('', false) . '.txt';
        Storage::disk('my_files')
            ->put('orders/' . $fileName, $result);

        return view('welcome')->with(['message' => "Файл $fileName у спешно записан"]);
    }
}
