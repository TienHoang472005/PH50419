<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('categories')->orderBy('id', 'desc');
        if($request->has('search')){
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $categories = $query->paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        DB::table('categories')->insert([
            'name' => $request->name,
            'status' =>(bool) $request->status,

        ]);
        return redirect()->route('categories.index')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // lấy ra dữ liệu của ID
        $category = DB::table('categories')->where('id', $id)->first();
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // lấy ra dữ liệu của ID cần chỉnh sửa
        $category = DB::table('categories')->where('id', $id)->first();
        return view('categories.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        DB::table('categories')->where('id', $id)->update([
            'name' => $request->name,
            'status' => (bool) $request->status,
        ]);
        return redirect()->route('categories.index')->with('success', 'Cập nhật thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa thành công');
    }
}
