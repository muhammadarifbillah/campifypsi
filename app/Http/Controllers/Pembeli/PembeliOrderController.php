<?php
namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembeli\Order_pembeli;

class PembeliOrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = Order_pembeli::where('user_id', $user->id)->latest()->get();
        return view('pembeli.orders.index_pembeli', compact('orders', 'user'));
    }

    public function detail($id)
    {
        $pesanan = Order_pembeli::with('details.product')->where('user_id', auth()->id())->findOrFail($id);
        return view('pembeli.orders.detail_pembeli', compact('pesanan'));
    }

    public function returnForm($detail_id)
    {
        $detail = \App\Models\Pembeli\OrderDetail_pembeli::with('product')->findOrFail($detail_id);
        $pesanan = Order_pembeli::findOrFail($detail->order_id);
        
        // Cek kepemilikan
        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pembeli.orders.return_pembeli', compact('detail', 'pesanan'));
    }

    public function cancel($id)
    {
        $pesanan = Order_pembeli::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        if (in_array($pesanan->status, ['menunggu', 'diproses'])) {
            $pesanan->status = 'dibatalkan';
            $pesanan->save();
            return back()->with('success', 'Pesanan dibatalkan');
        }
        return back()->with('error', 'Pesanan tidak dapat dibatalkan');
    }
}
