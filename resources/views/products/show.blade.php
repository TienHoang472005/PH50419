@extends('layouts.app')
@section('title', 'Xem chi tiết sản phẩm')
@section('content')
    <style>
        .mb-3 input {
            background-color: antiquewhite
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h4>Xem chi tiết sản phẩm</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá sản phẩm</label>
                <input type="number" class="form-control" name="price" value="{{ $product->price }}" readonly>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}" readonly>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh</label>
                <td><img src="{{ asset('storage/products/' . basename($product->image)) }}" alt="" width="100"
                        height="100"></td>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <input type="text" class="form-control" name="category_id" value="{{ $product->category->name }}"
                    readonly>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <input type="text" class="form-control" name="description" id="description" placeholder=""
                    value="{{ $product->description }}" readonly />
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <input type="text" class="form-control" name="status"
                    value="{{ $product->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}" readonly>
            </div>
        </div>

    </div>
@endsection
