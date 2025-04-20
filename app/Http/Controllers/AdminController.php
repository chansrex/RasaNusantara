<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin
     */
    public function dashboard()
    {
        // Menghitung jumlah pesanan
        $totalOrders = Order::count();
        
        // Menghitung jumlah menu
        $totalMenus = Menu::count();
        
        // Menghitung total omzet
        $totalRevenue = Order::sum('total_price');
        
        // Mengambil data pesanan terbaru
        $recentOrders = Order::with('user', 'orderItems.menu')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Mendapatkan data untuk produk terlaris
        $topProducts = OrderItem::select('menu_id', DB::raw('count(*) as total'))
            ->with('menu')
            ->groupBy('menu_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalOrders', 
            'totalMenus', 
            'totalRevenue', 
            'recentOrders',
            'topProducts'
        ));
    }
    
    /**
     * Tampilkan daftar menu
     */
    public function menuList()
    {
        $menus = Menu::orderBy('name')->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }
    
    /**
     * Tampilkan form tambah menu
     */
    public function createMenu()
    {
        return view('admin.menu.create');
    }
    
    /**
     * Simpan menu baru
     */
    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'nutrition_info' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'available' => 'boolean',
        ]);
        
        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'nutrition_info' => $request->nutrition_info,
            'price' => $request->price,
            'available' => $request->available ?? true,
        ]);
        
        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }
    
    /**
     * Tampilkan form edit menu
     */
    public function editMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }
    
    /**
     * Update menu
     */
    public function updateMenu(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'nutrition_info' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'available' => 'boolean',
        ]);
        
        $menu = Menu::findOrFail($id);
        
        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'nutrition_info' => $request->nutrition_info,
            'price' => $request->price,
            'available' => $request->available ?? false,
        ]);
        
        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil diperbarui');
    }
    
    /**
     * Hapus menu
     */
    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        
        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil dihapus');
    }
    
    /**
     * Tampilkan daftar pesanan
     */
    public function orderList()
    {
        $orders = Order::with('user', 'orderItems.menu')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.orders.index', compact('orders'));
    }
    
    /**
     * Tampilkan detail pesanan
     */
    public function orderDetail($id)
    {
        $order = Order::with('user', 'orderItems.menu')
            ->findOrFail($id);
            
        return view('admin.orders.detail', compact('order'));
    }
    
    /**
     * Update status pesanan
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,ready',
        ]);
        
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->route('admin.orders.detail', $id)
            ->with('success', 'Status pesanan berhasil diperbarui');
    }
    
    /**
     * Tampilkan laporan
     */
    public function reports()
    {
        // Member teraktif (paling banyak melakukan pemesanan)
        $activeMember = User::select('users.id', 'users.name', DB::raw('count(orders.id) as order_count'))
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->groupBy('users.id', 'users.name')
            ->orderBy('order_count', 'desc')
            ->first();
            
        // Member dengan pembelian terbanyak (berdasarkan total pembelian)
        $topSpender = User::select('users.id', 'users.name', DB::raw('sum(orders.total_price) as total_spent'))
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_spent', 'desc')
            ->first();
            
        // Transaksi terbanyak (hari dengan pemesanan terbanyak)
        $peakOrderDay = Order::select(DB::raw('DATE(created_at) as order_date'), DB::raw('count(*) as order_count'))
            ->groupBy('order_date')
            ->orderBy('order_count', 'desc')
            ->first();
            
        // Total omzet
        $totalRevenue = Order::sum('total_price');
        
        // Produk terlaris
        $topProduct = OrderItem::select('menu_id', DB::raw('count(*) as total'))
            ->with('menu')
            ->groupBy('menu_id')
            ->orderBy('total', 'desc')
            ->first();
            
        // Produk yang jarang dibeli (kandidat untuk diendorse/dipromosikan)
        $leastOrderedProducts = Menu::select('menus.id', 'menus.name', DB::raw('count(order_items.id) as order_count'))
            ->leftJoin('order_items', 'menus.id', '=', 'order_items.menu_id')
            ->where('menus.available', true)
            ->groupBy('menus.id', 'menus.name')
            ->orderBy('order_count', 'asc')
            ->take(5)
            ->get();
            
        return view('admin.reports', compact(
            'activeMember',
            'topSpender',
            'peakOrderDay',
            'totalRevenue',
            'topProduct',
            'leastOrderedProducts'
        ));
    }
} 