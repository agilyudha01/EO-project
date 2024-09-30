<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        // dd($user->badges);
        return view('profile', compact('user', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findOrFail($id);

        // Jika tidak ada file gambar, lakukan update pada field lain
        if (! $request->hasFile('profile_image')) {
            // dd($request);
            $validateData = $request->validate([
                'name' => 'string',
                'phone' => 'string', // Gunakan string atau numeric, tidak ada 'number' dalam validasi
                'address' => 'string',
            ]);
            // dd($validateData);

            // Update field lain
            $user->name = $validateData['name'];;
            $user->phone = $validateData['phone'];
            $user->address = $validateData['address'];

        } else {
            // Jika ada file gambar, lakukan validasi gambar
            $validateData = $request->validate([
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Proses upload file gambar baru
            if ($request->hasFile('profile_image')) {
                // Hapus gambar lama jika ada
                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }

                // Simpan gambar baru
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $user->image = $imagePath;
            }
        }
        // Simpan perubahan user
        // dd($user);
        $user->update();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui tanpa mengubah foto.');
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
