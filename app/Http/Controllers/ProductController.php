<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.produk.produk', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

            $product = new Product();
            $product->nama_produk = $request->nama_produk;
            $product->category_id = $request->kategori_id;
            $product->harga = $request->harga;
            $product->stok = $request->stok;
            $product->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/produk'), $filename);
            $product->image =  $filename;
        }

        $product->save();

        return redirect()->route('products.index')->with('toast_success', 'Produk berhasil ditambahkan');
    }

    public function destroy($id)
    {
        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->image) {
            // Menghapus gambar dari direktori
            $gambarPath = public_path('uploads/produk/' . $product->image);
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        // Hapus produk dari database
        $product->delete();

        // Tampilkan SweetAlert setelah berhasil dihapus
        Alert::success('Berhasil', 'Kategori berhasil dihapus');

        return redirect()->route('products.index')->with('toast_success', 'Produk berhasil dihapus');
    }
}
