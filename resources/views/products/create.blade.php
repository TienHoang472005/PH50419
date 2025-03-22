@extends('layouts.app')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success')}}
    </div>  
@endif
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error')}}
    </div>  
@endif
@section('title', 'Thêm sản phẩm')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Thêm sản phẩm</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="price">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" name="quantity">
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select class="form-select" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="" />
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select class="form-select" name="status">
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm dừng</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                <button class="btn btn-success" type="submit">Thêm sản phẩm</button>
            </form>
        </div>

    </div>
@endsection
