<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EventPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $eventPackages = EventPackage::all();
        // dd($categories);
        return view('user.home', compact('user', 'eventPackages'));
    }

    public function package(Request $request) {
        $search = $request->input('search');
        $filter = $request->input('filter', 'asc'); // Default filter asc
        $category = $request->input('category'); // Ambil kategori dari request
        $categories = Category::all(); // Ambil semua kategori untuk keperluan filter
        $query = EventPackage::query()->with('categories'); // Query utama dengan relasi categories
    
        // Jika ada pencarian nama package (opsional, jika ada search feature)
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        // Jika kategori tidak kosong, tambahkan filter berdasarkan kategori
        if (!empty($category)) {
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category);
            });
        }
    
        // Urutkan berdasarkan filter harga (asc/desc)
        $query->orderBy('price', $filter);
    
        // Eksekusi query dan ambil hasil
        $eventPackages = $query->get();
    
        // Kembalikan view dengan data
        return view('user.package', compact('eventPackages', 'categories', 'search', 'filter', 'category'));
    }
    
    
    public function search(Request $request){
        // dd($request);
        // Mulai query dengan hasil pencarian (misalnya search berdasarkan nama package)
        $filter = null;
        $search = null;
        $query = EventPackage::query();
        $categories = Category::all();
        // dd($request);
        
        // Jika ada pencarian nama package
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }
        // Lakukan filtering berdasarkan request filter (asc/desc)
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            $query->where('name', 'like', '%' . $search . '%')->orderBy('price', $filter);
        }

        // Ambil hasil query
        $eventPackages = $query->get();

        return view('user.search', compact('eventPackages', 'search', 'categories'));
    }
    public function detailPackage(EventPackage $eventPackage){
        $user = Auth::user();
        $categories = Category::all();
        // $eventPackages = EventPackage::all();
        // dd($eventPackage);
        return view('user.packageDitail', compact('user', 'eventPackage', 'categories'));
    }

}
