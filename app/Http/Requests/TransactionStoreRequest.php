<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TransactionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id.*' => ['required', 'exists:products,id'],
            'quantity.*' => ['required'],
            'total_price' => ['required'],
            'status' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'product_id.*.required' => 'Produk wajib diisi',
            'product_id.*.exists' => 'Produk tidak ditemukan',
            'quantity.*.required' => 'Jumlah wajib diisi',
            'total_price.required' => 'Total harga wajib diisi',
            'status.required' => 'Status transaksi wajib diisi'
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
