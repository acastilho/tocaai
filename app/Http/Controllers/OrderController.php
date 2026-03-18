<?php
namespace App\Http\Controllers;

use App\Models\SongRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "song_id" => "required",
            "customer_name" => "required",
            "receipt" => "required|image|mimes:jpeg,png,jpg|max:10240" 
        ]);

        $path = $request->file("receipt")->store("receipts", "public");

        $order = new SongRequest();
        $order->song_id = $request->song_id;
        $order->customer_name = $request->customer_name;
        $order->status = "pending";
        // $order->receipt_path = $path; // Ative após criar a migration
        $order->save();

        return back()->with("success", "Pedido enviado!");
    }
}
