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
@section('title', 'Sửa danh mục')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Sửa danh mục</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name}}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select class="form-select" name="status">
                        <option value="1" {{$category->status == 1 ? "selected": ""}}>Hoạt động</option>
                        <option value="0" {{$category->status == 0 ? "selected": ""}}>Tạm dừng</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                <button class="btn btn-success" type="submit">Sửa danh mục</button>
            </form>
        </div>

    </div>
@endsection
