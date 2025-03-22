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
@section('title', 'Danh sách danh mục')
@section('content')

    <div class="container">
        <h2>Danh sách danh mục</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
        <hr>
        <form method="get" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm danh mục..."
                    value="{{ request('search') }}">

                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>        
            </div>
        </form>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}</td>
                        <td>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-success">Xem chi tiết</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{route('categories.destroy', $category->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa không')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
