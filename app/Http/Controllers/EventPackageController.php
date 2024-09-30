<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EventPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari request
        // dd($request);
        $user = Auth::user();
        $categories = Category::all();
        $categoryId = $request->input('category');
        // dd($user);
        
        if ($categoryId) {
            $eventPackages = EventPackage::whereHas('categories', function($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })->get();
            // dd($eventPackages);
        } else {
            // Ambil semua eventPackages jika tidak ada pencarian
            // $eventPackages = EventPackage::with('categories', 'user')->get();
            $eventPackages = EventPackage::with('categories')->get();
        }
        
        // return view('event-packages.index', compact('eventPackages'));
        return view('admin.paket.paket', compact('eventPackages', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.paket.tambahPaket', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|file', // 'nullable' added in case the image is optional
            'description' => 'required|string',
            'price' => 'required|integer',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('event_images', 'public');
        }
        // dd($validatedData['image']);

        // Simpan EventPackage
        $eventPackage = EventPackage::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $validatedData['image'], // Assign null if no image
        ]);

        // Lampirkan kategori ke EventPackage
        $eventPackage->categories()->attach($validatedData['categories']);

        // return redirect()->route('admin.event-package')->with('success', 'Event Package created successfully.');
        return redirect('admin/event-package')->with('success', 'Event Package created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $eventPackage = EventPackage::with('categories')->findOrFail($id);
        // dd($eventPackage);
        return view('admin.paket.show', compact('eventPackage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eventPackage = EventPackage::findOrFail($id);
        $categories = Category::all();
        return view('admin.paket.edit', compact('eventPackage', 'categories'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|file',
            'description' => 'required|string',
            'price' => 'required|integer',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);
    
        $eventPackage = EventPackage::findOrFail($id);
    
        // Handle file upload and delete old file if necessary
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($eventPackage->image && Storage::exists('public/' . $eventPackage->image)) {
                Storage::delete('public/' . $eventPackage->image);
            }
    
            // Store the new image
            $validatedData['image'] = $request->file('image')->store('event_images', 'public');
        } else {
            // Retain the old image if no new image is uploaded
            $validatedData['image'] = $eventPackage->image;
        }
    
        // Update event package data
        $eventPackage->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $validatedData['image'],
        ]);
    
        // Update categories
        $eventPackage->categories()->sync($validatedData['categories']);
    
        return redirect()->route('event-package.index')->with('success', 'Event Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventPackage = EventPackage::findOrFail($id);
        $eventPackage->categories()->detach(); // Menghapus hubungan many-to-many
        $eventPackage->delete();

        return redirect()->route('event-package.index')->with('success', 'Event Package deleted successfully.');
    }
}
