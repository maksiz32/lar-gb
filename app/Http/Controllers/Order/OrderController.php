<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\OrderRequest;

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

    public function save(OrderRequest $request)
    {
        if (isset($request->id)) {
            $order = Order::find($request->id);
        } else {
            $order = new Order();
        }
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->order = $request->order;

        if ($order->save()) {
            return redirect(action([__CLASS__, 'index']))
                ->with(['message' => "Заказ от {$order->name} успешно создан"]);
        } else {
            return back()->with(['errors' => 'Ошибка сохранения']);
        }
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
