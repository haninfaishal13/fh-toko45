<?php
namespace App\Imports;

use App\Models\Product;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach($collection as $key => $value) {
                $data = [];
                $data['name'] = $value['name'];
                $data['category_id'] = $value['category_id'];
                $data['price'] = $value['price'];
                $data['quantity'] = $value['quantity'];
                Product::create($data);
            }
            DB::commit();
            $this->data = [
                'status' => true,
                'message' => 'Data berhasil diimport',
                'status_code' => '201'
            ];
            return;
        } catch(Exception $e) {
            $this->data = [
                'status' => false,
                'message' => [$e->getMessage()],
                'status' => '422'
            ];
            return;
        }
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'int', 'min:0'],
            'quantity' => ['required', 'int', 'min:0']
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Nama produk wajib diisi',
            'category_id.required' => 'Kategori produk wajib diisi',
            'category_id.exists' => 'Kategori tidak ditemukan',
            'price.required' => 'Harga wajib diisi',
            'price.int' => 'Harga wajib dalam bentuk angka',
            'price.min' => 'Harga minimal 0',
            'quantity.required' => 'Jumlah wajib diisi',
            'quantity.int' => 'Jumlah wajib dalam bentuk angka',
            'quantity.min' => 'Jumlah minimal 0'
        ];
    }
}
?>
