<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không được quá 255 ký tự',
            'price.required' => 'Giá không được để trống',
            'price.integer' => 'Giá phải là số',
            'price.min' => 'Giá không được nhỏ hơn 0',
            'quantity.required' => 'Số lượng không được để trống',
            'quantity.integer' => 'Số lượng phải là số',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1',
            'image.image' => 'Hình ảnh phải là hình ảnh',
            'image.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg, png',
            'image.max' => 'Hình ảnh không được quá 2048 ký tự',
            'category_id.required' => 'Danh mục không được để trống',
            'category_id.exists' => 'Danh mục không tồn tại',
            'description.string' => 'Mô tả phải là chuỗi',
            'description.max' => 'Mô tả không được quá 255 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'status.boolean' => 'Trạng thái phải là boolean',
        ];
    }
}
