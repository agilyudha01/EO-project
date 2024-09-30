<?php

namespace App\Http\Controllers;

use App\Models\EventPackage;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // dd($user->badges);
        $orders = Order::with(['user'])->latest()->get();
        $eventPackages = EventPackage::with('categories')->latest()->get();
        $totalEventPackage = EventPackage::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalPrice = Order::where('status', 'like', 'confirmed')
                            ->orWhere('status', 'like', 'completed')->sum('price');
        $totalPrice = number_format($totalPrice, 0, ',', '.');

        // Chart 1
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',];
        Carbon::setLocale('id');
        $currentWeekOrdersPrice = [];
        $previousWeekOrdersPrice = [];

        $currentWeekOrders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(function($query) {
                $query->where('status', 'like', 'confirmed')
                    ->orWhere('status', 'like', 'completed');
            })
            ->selectRaw('DATE(created_at) as date, SUM(price) as total_price')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        foreach ($days as $day) {
            $found = false; // Untuk mengecek apakah hari ditemukan di dalam pesanan
        
            foreach ($currentWeekOrders as $order) {
                // Cek apakah nama hari pesanan cocok dengan hari dari array $days
                if (Carbon::parse($order->date)->translatedFormat('l') == $day) {
                    $currentWeekOrdersPrice[] = $order->total_price; // Masukkan total harga jika cocok
                    $found = true;
                    break; // Keluar dari loop pesanan jika sudah ditemukan
                }
            }
        
            // Jika hari tidak ditemukan dalam pesanan, tambahkan 0
            if (!$found) {
                $currentWeekOrdersPrice[] = 0;
            }
        }
        // dd($currentWeekOrdersPrice);
        
        // Ambil total price berdasarkan minggu sebelumnya
        $previousWeekOrders = Order::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->where(function($query) {
                $query->where('status', 'like', 'confirmed')
                    ->orWhere('status', 'like', 'completed');
            })    
            ->selectRaw('DATE(created_at) as date, SUM(price) as total_price')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();
            
        foreach ($days as $day) {
            $found = false; // Untuk mengecek apakah hari ditemukan di dalam pesanan
        
            foreach ($previousWeekOrders as $order) {
                // Cek apakah nama hari pesanan cocok dengan hari dari array $days
                if (Carbon::parse($order->date)->translatedFormat('l') == $day) {
                    $previousWeekOrdersPrice[] = $order->total_price; // Masukkan total harga jika cocok
                    $found = true;
                    break; // Keluar dari loop pesanan jika sudah ditemukan
                }
            }
        
            // Jika hari tidak ditemukan dalam pesanan, tambahkan 0
            if (!$found) {
                $previousWeekOrdersPrice[] = 0;
            }
        }
        // dd($previousWeekOrdersPrice);

        // Chart 2 Transaction status
        $chart2 = Order::select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->get();



        return view('admin.dashboard', compact('orders', 'eventPackages', 'totalPrice', 'totalOrders', 'totalEventPackage', 'totalUsers', 'currentWeekOrders', 'previousWeekOrders', 'currentWeekOrdersPrice', 'previousWeekOrdersPrice', 'days', 'chart2'));
        
        
    }
}
