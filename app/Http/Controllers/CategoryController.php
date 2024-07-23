<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $categories = Category::all();
        return view('admin.kategori.kategori', compact('categories'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ket' => 'required|string',
        ]);

        // Buat instance kategori baru
        $category = new Category();
        $category->nama_kategori = $request->nama_kategori;

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kategori'), $filename);
            $category->gambar = $filename;
        }

        $category->ket = $request->ket;
        $category->save();
        return redirect()->route('categories.index')->with('toast_success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.kategori.edit', compact('category'));
}

public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ket' => 'required|string',
        ]);

        // Temukan kategori berdasarkan ID
        $category = Category::findOrFail($id);
        $category->nama_kategori = $request->nama_kategori;

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($category->gambar) {
                $gambarPath = public_path('uploads/kategori/' . $category->gambar);
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kategori'), $filename);
            $category->gambar = $filename;
        }

        $category->ket = $request->ket;
        $category->save();

        return redirect()->route('categories.index')->with('toast_success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Temukan kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Hapus gambar jika ada
        if ($category->gambar) {
            // Menghapus gambar dari direktori
            $gambarPath = public_path('uploads/kategori/' . $category->gambar);
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        // Hapus kategori dari database
        $category->delete();

        // Tampilkan SweetAlert setelah berhasil dihapus
        Alert::success('Berhasil', 'Kategori berhasil dihapus');

        return redirect()->route('categories.index');
    }
}
