<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // Index - Menampilkan semua user
    public function index()
    {
        $users = User::with('badges', 'orders')
            ->where('level_user', 'user')
            ->get();
        // dd($users);
        return view('admin.user.customer', compact('users'));
    }

    // Create - Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('admin.user.user.createCustomer');
    }

    // Store - Menyimpan user baru
    public function store(Request $request)
    {
        // dd($request);
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'password' => 'required|min:6',
        ]);
        // dd($validateData);

        $path = null;
        if ($request->file('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
        }
        // dd($path);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'level_user' => 'user', // atau 'customer'
            // 'badge_id' => $request->badge_id,
            'image' => $path,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('customer.index')->with('success', 'User berhasil dibuat.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        // dd($eventPackage);
        return view('admin.user.show', compact('user'));
    }

    // Edit - Menampilkan form untuk mengedit user
    public function edit($id)
    {
        // $user = User::findOrFail($id);
        // return view('admin.user.edit', compact('user'));
    }

    // Update - Menyimpan perubahan user
    public function update(Request $request, $id)
    {
        $user= User::findOrFail($id);
        // Validasi file gambar
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload file gambar baru
        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::delete('storage/' . $user->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        // Simpan perubahan user
        $user->update();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    // Destroy - Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->image) {
            Storage::delete('public/' . $user->image);
        }

        $user->delete();

        return redirect()->route('customer.index')->with('success', 'User berhasil dihapus.');
    }
}
