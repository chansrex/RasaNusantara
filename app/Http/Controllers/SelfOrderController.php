<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SelfOrderController extends Controller
{
    /**
     * Menampilkan halaman menu utama
     */
    public function index()
    {
        // Jika user sudah login sebagai customer, redirect ke menu
        if (Auth::check() && Auth::user()->role === 'customer') {
            return redirect()->route('self-order.menu');
        }
        
        // Tampilkan form registrasi sederhana
        return view('self-order.register');
    }

    /**
     * Menampilkan detail menu
     */
    public function showMenu($id)
    {
        $menu = Menu::with('ingredients')->findOrFail($id);
        return view('self-order.menu-detail', compact('menu'));
    }

    /**
     * Menampilkan keranjang belanja
     */
    public function cart()
    {
        return view('self-order.cart');
    }

    /**
     * Menambahkan item ke keranjang
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'custom_notes' => 'nullable|string',
            'portion_size' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);

        $menu = Menu::find($request->menu_id);
        $cart[] = [
            'menu_id' => $menu->id,
            'name' => $menu->name,
            'price' => $menu->price,
            'custom_notes' => $request->custom_notes,
            'portion_size' => $request->portion_size,
        ];

        session()->put('cart', $cart);
        return redirect()->route('self-order.cart')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    /**
     * Menghapus item dari keranjang
     */
    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', array_values($cart));
        }
        
        return redirect()->route('self-order.cart')->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    /**
     * Memproses checkout
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'order_type' => 'required|in:dine-in,take-away',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('self-order.cart')->with('error', 'Keranjang kosong!');
        }

        // Hitung total harga
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'];
        }

        // Buat order baru
        $order = Order::create([
            'user_id' => Auth::id() ?? 1, // Default ke user_id 1 jika tidak ada auth
            'order_type' => $request->order_type,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'total_price' => $totalPrice,
        ]);

        // Simpan item-item order
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['menu_id'],
                'custom_notes' => $item['custom_notes'] ?? null,
                'portion_size' => $item['portion_size'] ?? null,
            ]);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        return view('self-order.order-success', compact('order'));
    }

    /**
     * Menampilkan status pesanan
     */
    public function orderStatus($orderId)
    {
        $order = Order::with('orderItems.menu')->findOrFail($orderId);
        return view('self-order.order-status', compact('order'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        // Cek apakah email sudah terdaftar
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            // Buat user baru dengan role customer
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::random(12)), // Generate random password
                'role' => 'customer',
                'language' => 'id',
                'is_accessible_mode' => $request->has('is_accessible_mode'),
            ]);
        }
        
        // Login user
        Auth::login($user);
        
        return redirect()->route('self-order.menu');
    }

    public function menu()
    {
        // Ambil semua menu yang available
        $menus = Menu::where('available', true)->get();
        
        // Ambil pesanan aktif dari user saat ini
        $activeOrders = [];
        if (Auth::check()) {
            $activeOrders = Order::where('user_id', Auth::id())
                ->whereIn('status', ['pending', 'processing', 'ready'])
                ->with('orderItems.menu')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        // Tampilkan menu makanan
        return view('self-order.menu', compact('menus', 'activeOrders'));
    }
    
    /**
     * Menampilkan riwayat pesanan pelanggan
     */
    public function orderHistory()
    {
        if (!Auth::check()) {
            return redirect()->route('self-order.index');
        }
        
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.menu')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('self-order.order-history', compact('orders'));
    }
} 