@extends('layouts.app')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
@section('title', 'Danh sách sản phẩm')
@section('content')

    <div class="container">
        <h2>Danh sách sản phẩm</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
        <hr>
        <form method="get" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm..."
                    value="{{ request('search') }}">

                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>        
            </div>
        </form>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td><img src="{{ asset('storage/products/' . basename($product->image)) }}" alt="" width="100" height="100"></td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}</td>
                        <td style="display: flex; align-items: center; gap: 5px;">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">Xem</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{route('products.destroy', $product->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
