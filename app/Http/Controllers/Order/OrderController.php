<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.all', ['orders' => Order::paginate(3)]);
    }

    public function edit(Order $order)
    {
        return view('orders.edit', ['order' => $order]);
    }

    public function create()
    {
        return view('orders.input');
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'id' => 'integer|exists:orders,id',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|regex:/^.+@.+$/i',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'order' => 'required|string'
                                        ]);

        if (isset($validated['id'])) {
            $order = Order::find($validated['id']);
        } else {
            $order = new Order();
        }
        $order->name = $validated['name'];
        $order->phone = $validated['phone'];
        $order->email = $validated['email'];
        $order->order = $validated['order'];

        $order->save();

        return redirect(action([__CLASS__, 'index']))
            ->with(['message' => "Заказ от {$order->name} успешно создан"]);
    }

    public function destroy(int $id)
    {
        $order = Order::findOrFail($id);
        $user_name = $order->name;
        $order->delete();

        return redirect(action([__CLASS__, 'index']))
            ->with(['message' => "Заказ от {$user_name} удалён"]);
    }
}
