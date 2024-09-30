<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\EventPackage;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all(); // Ambil semua pengguna untuk ditampilkan di dropdown

        $userId = $request->input('user'); // Ambil userId dari request
        if ($userId) {
            // Jika ada userId, ambil orders yang terkait dengan pengguna tersebut
            $orders = Order::with(['eventPackage', 'user']) // Eager load eventPackage dan user
                ->where('user_id', $userId) // Filter berdasarkan user_id
                ->get();
        } else {
            // Jika tidak ada filter user, ambil semua orders
            $orders = Order::with(['eventPackage', 'user'])->get(); // Eager load eventPackage dan user
        }

        return view('admin.transaksi.transaksi', compact('orders', 'users'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->event_date);
        // Ambil informasi event package berdasarkan ID
        // $eventPackage = EventPackage::find($request->eventPackage_id);
        // // dd($eventPackage);

        // // Ambil user yang sedang login
        // $user = Auth::user();
        // // dd($user);
        // $event_date = $request->event_date;
        // // dd($event_date);

        // // Kirim data ke view checkout
        // return view('admin.transaksi.transaksi', compact('eventPackage', 'user', 'event_date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // $validatedData = $request->validate([
        //     'eventPackage_id' => 'required|exists:event_packages,id',
        //     'event_date' => 'required|date',
        // ]);
        // // dd($validatedData);

        // // Ambil informasi event package berdasarkan ID
        // $eventPackage = EventPackage::find($request->eventPackage_id);
        // // dd($eventPackage);

        // // Ambil user yang sedang login
        // $user = Auth::user();
        // // dd($user);

        // // Buat order baru
        // Order::create([
        //     'user_id' => $user->id,
        //     'event_package_id' => $validatedData['eventPackage_id'],
        //     'price' => $eventPackage->price,
        //     'event_date' => $validatedData['event_date'], // Assign null if no image
        // ]);


        // // Redirect ke halaman sukses atau order detail
        // // return redirect()->route('order.show', $order->id)
        // return redirect()->route('/order')
        //                 ->with('success', 'Order berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'status' => 'required|string|max:255',
        ]);
        // dd($validatedData);
        $order = Order::findOrFail($id);
        $user = $order->user;

        $order->update([
            'status' =>  $validatedData['status'],
        ]);
        $totalPrice = $user->orders->where('status', 'Completed')->sum('price');
        // dd($totalPrice);
        // Temukan badge yang sesuai
        $badgeId = Badge::where('min_total_transaction', '<=', $totalPrice)
                        ->orderBy('min_total_transaction', 'desc')
                        ->value('id');  // Hanya ambil nilai kolom 'id'

        // dd($badgeId);
        // Perbarui data pengguna jika badgeId tidak null
        $user->update([
            'badge_id' => $badgeId,
            'total_success_transaction' => $totalPrice,
            'updated_at' => now(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Event Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Event Package deleted successfully.');
    }
}
