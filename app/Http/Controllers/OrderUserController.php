<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Category;
use App\Models\EventPackage;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user->total_success_transaction);
        // dd($user->orders->count());
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc') ->get();
        return view('user.transaksi', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
        // Ambil informasi event package berdasarkan ID
        $categories = Category::all();
        $eventPackage = EventPackage::find($request->eventPackage_id);
        // dd($eventPackage);

        // Ambil user yang sedang login
        $user = Auth::user();
        // $badges = $user->badges;
        // dd($user);
        $event_date = $request->event_date;
        // dd($event_date);
        $diskon = ($user->badges->discount / 100)* $eventPackage->price;
        $total = $eventPackage->price - $diskon;

        // Kirim data ke view checkout
        return view('user.checkout', compact('eventPackage', 'user', 'event_date', 'total', 'diskon', 'categories'));
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
        $validatedData = $request->validate([
            'eventPackage_id' => 'required|exists:event_packages,id',
            'event_date' => 'required|date',
            'address' => 'required|string',
            'total_price' => 'required',
        ]);
        // dd($validatedData);
        // dd($validatedData['event_date']);

        // Ambil informasi event package berdasarkan ID
        // $eventPackage = EventPackage::find($request->eventPackage_id);
        // dd($eventPackage);

        // Ambil user yang sedang login
        $user = Auth::user();
        
        // dd($user);

        // Buat order baru
        $order = Order::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'address' => $validatedData['address'],
            'event_package_id' => $validatedData['eventPackage_id'],
            'price' => $validatedData['total_price'],
            'event_date' => $validatedData['event_date'],
        ]);

        // dd($order->id);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->price,
            ),
            'customer_details' => array(
                'first_name' => $order->user->name,
                'last_name' => '',
                'email' => $order->user->email,
                'phone' => $order->user->phone,
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->snapToken = $snapToken;
        $order->update();
        

        return view('user.paymentGateaway', compact('order'));
    }

    public function callback(Request $request){
        // dd($request);
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement'){
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Confirmed']);
            } elseif ($request->transaction_status == 'expire' or $request->transaction_status == 'deny' or $request->transaction_status == 'cancel') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Failed']);
            }
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
