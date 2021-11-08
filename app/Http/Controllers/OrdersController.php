<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use Orion\Http\Requests\Request;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class OrdersController extends Controller
{
    use DisableAuthorization;

    protected $model = Order::class;

    protected $request = OrderRequest::class;

    protected function afterSave(Request $request, $order)
    {
        // Supplier
        $supplier = User::find($order->supplier_id);

        if ($supplier) {
            $fee = $order->total * $supplier->fee / 100;
            $order->fee = $fee;
            $order->save();
        }
    }
}
