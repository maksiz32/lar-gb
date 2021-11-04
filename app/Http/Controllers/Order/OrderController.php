<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('orders.all', ['orders' => Order::paginate(3)]);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Order $order)
    {
        return view('orders.edit', ['order' => $order]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('orders.input');
    }

    /**
     * @param OrderRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
                ->with(['message' => __('messages.admin.order.save.success')]);
        }

        return back()->with(['errors' => __('messages.admin.order.save.fail')]);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();

            return response()->json(['message' => __('messages.admin.order.destroy.success')]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . PHP_EOL, $e->getTrace());

            return response()->json(['message' => __('messages.admin.order.destroy.fail')]);
        }
    }
}
