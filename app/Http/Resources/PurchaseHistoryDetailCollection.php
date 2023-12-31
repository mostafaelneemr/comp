<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PurchaseHistoryDetailCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'order_id'=>$data->order_id,
                    'product' => $data->product->{'name_'.locale()},
                    'variation' => $data->variation,
                    'price' => $data->price,
                    'tax' => $data->tax,
                    'shipping_cost' => $data->shipping_cost,
                    'quantity' => $data->quantity,
                    'payment_status' => $data->payment_status,
                    'delivery_status' => $data->delivery_status
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
