<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'category_code' => ['required','unique:categories,category_code'],
            'section' => ['required', 'in:toko,laundry']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kategori wajib diisi',
            'category_code.required' => 'Kode kategori wajib diisi',
            'category_code.unique' => 'Kode kategori sudah digunakan',
            'section.required' => 'Bagian kategori wajib diisi'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 422)
        );
    }
}
