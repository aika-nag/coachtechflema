<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Order;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;

class OrderController extends Controller
{
    //
    public function purchase(Item $item)
    {
        $user = auth()->user();

        $address = Profile::where('user_id', $user->id)->first();

        $data = [
            'item' => $item,
            'profile' => $address
        ];

        return view('purchase', $data);

    }

    public function changeAddress(AddressRequest $request, Item $item_id)
    {
        $profile = array(
            'zipcode' => $request->zipcode,
            'address' => $request->address,
            'building' => $request->building
        );

        $item = $item_id->id;

        return redirect("/purchase/{$item}")->with(compact(
            'profile'));
    }

    public function editAddress(Request $request, Item $item_id)
    {
        $data = [
            'item' => $item_id,
            'payment' => $request->payment
        ];

        return view('address', $data);
    }

    public function order(PurchaseRequest $request, Item $item_id)
    {
        $user = auth()->user();
        dd($request);

        $order = new Order();
        $order->buyer_id = $user->id;
        $order->item_id = $item_id->id;
        $order->payment = $request->payment;
        $order->delivery_zipcode = $request->zipcode;
        $order->delivery_address = $request->address;
        $order->delivery_building = $request->building;

        $order->save();

        return redirect('/');
    }
}
