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
@section('title', 'Sửa sản phẩm')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Sửa sản phẩm</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh hiện tại</label>
                    <td><img src="{{ asset('storage/products/' . basename($product->image)) }}" alt=""
                            width="100" height="100"></td>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh mới</label>
                    <input type="file" class="form-control" name="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select class="form-select" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder=""
                        value="{{ $product->description }}" />
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select class="form-select" name="status">
                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-success" type="submit">Sửa sản phẩm</button>
            </form>
        </div>

    </div>
@endsection
