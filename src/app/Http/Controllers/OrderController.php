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

        $data = [
            'item' => $item_id,
            'profile' => $profile,
            'payment' => $request->payment
        ];

        return view('purchase',$data);
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

        $Order = new Order();
        $Order->buyer_id = $user->id;
        $Order->seller_id = $item_id->user_id;
        $Order->item_id = $item_id->id;
        $Order->payment = $request->payment;
        $Order->delivery_zipcode = $request->zipcode;
        $Order->delivery_address = $request->address;
        $Order->delivery_building = $request->building;

        $Order->save();

        return redirect('/');
    }
}
