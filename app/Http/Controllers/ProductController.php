<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->orderBy('id', 'desc');
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get(); // Lấy danh sách danh mục
        return view('products.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Đổi tên file tránh trùng lặp
            $file->move(public_path('storage/products'), $fileName); // Lưu vào public/storage/products
            $imagePath = 'products/' . $fileName; // Đường dẫn lưu vào DB
        } else {
            $imagePath = null;
        }

        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath, // Lưu đường dẫn ảnh vào database
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => (bool) $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->where('id', $id)->first();
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {

        $product = DB::table('products')->where('id', $id)->first();

        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldImagePath = public_path('storage/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/products'), $fileName);
            $imagePath = 'products/' . $fileName;
        } else {
            $imagePath = $product->image;
        }

        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => (bool) $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Sửa sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Xóa thành công');
    }
}
