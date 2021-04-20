<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Order;
use App\Models\User;

use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    // Kullanıcının siparişlerini listelemek için.
    public function index() // Done
    {
        $user = Auth::user();
        if ($user->user_type == 'admin') {
            return response()->json(array('data' => Order::all() ));
        } else {
            return response()->json(array('data' => Auth::user()->orders ));
        }
    }

    // orderCode ile sipariş detaylarını almak için
    public function show($orderCode)  // Done
    {
        $user = Auth::user();
        if ($user->user_type == 'admin') {
            $order = Order::where('orderCode', $orderCode)->first();
        } else {
            $order = Order::where('user_id', Auth::user()->id)->where('orderCode', $orderCode)->first();
        }

        if ($order != null) {
            return response()->json(array('data' => $order));
        } else {
            return response()->json(['message' => 'Order could not be found.'], 479);
        }
    }

    // Yeni sipariş kaydı oluşturmak için
    public function store(Request $request) // Done
    {
        if (
        $request->has('address') && $request->address != null &&$request->has('productId') && $request->productId != null && $request->has('quantity') && $request->quantity != null && $request->has('shippingDate') && $request->shippingDate != null
      ) {
            // if( Order::where('orderCode',$request->orderCode)->first() != null ){
            //   return response()->json(['message' => 'There is already an order registered with this orderCode'], 479);
            // }
            $order = new Order;
            $order->orderCode = uniqid();
            $order->user_id = Auth::user()->id;
            $order->address = $request->address;
            $order->productId = $request->productId;
            $order->quantity = $request->quantity;
            $order->shippingDate = $request->shippingDate;

            if ($order->save()) {
                return response()->json(['message' => 'Order saved with orderCode : '.$order->orderCode], 479);
            } else {
                return response()->json(['message' => 'Something went wrong.'], 479);
            }
        } else {
            return response()->json(['message' => 'Some parameters are missing. Please check that your request has : orderCode,address,productId,quantity,shippingDate'], 479);
        }
    }

    // Siparişleri güncellemek için
    public function update(Request $request) // Done
    {
        if (!$request->has('orderCode') || $request->orderCode == null) {
            return response()->json(['message' => '"orderCode" parameter is missing'], 479);
        }


        $user = Auth::user();
        if ($user->user_type == 'admin') {
            $order = Order::where('orderCode', $request->orderCode)->first();
        } else {
            $order = $user->orders->where('orderCode', $request->orderCode)->first();
        }

        if ($order == null) {
            return response()->json(['message' => 'Order could not be found'], 479);
        }
        if (!$order->isUpdatable()) {
            return response()->json(['message' => 'Order cannot be updated because the last update date has passed.'], 479);
        }

        if ($request->has('address')) {
            $order->address = $request->address;
        }
        if ($request->has('productId')) {
            $order->productId = $request->productId;
        }
        if ($request->has('quantity')) {
            $order->quantity = $request->quantity;
        }
        if ($request->has('shippingDate')) {
            $order->shippingDate = $request->shippingDate;
        }

        if ($order->save()) {
            return response()->json(['message' => 'Order updated'], 200);
        } else {
            return response()->json(['message' => 'Something went wrong'], 479);
        }
    }
}
