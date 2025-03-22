@extends('layouts.app')
@section('title', 'Xem chi tiết danh mục')
<style>
    .mb-3 input {
        background-color: antiquewhite
    }
</style>
@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Xem chi tiết danh mục</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <input type="text" class="form-control" name="status"
                    value="{{ $category->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}" readonly>
            </div>

        </div>
    @endsection
