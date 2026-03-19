<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'musician_id' => 'required|exists:musicians,id',
            'song_id' => 'required|exists:songs,id',
            'client_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        Order::create([
            'musician_id' => $data['musician_id'],
            'song_id' => $data['song_id'],
            'client_name' => $data['client_name'],
            'amount' => $data['amount'],
            'status' => 'pending',
        ]);

        return back()->with([
            'success' => 'Pedido enviado!',
            'audio_name' => $data['client_name'],
            'audio_amount' => $data['amount']
        ]);
    }

    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'completed']);
        return back()->with('success', 'Pedido concluído!');
    }
}
