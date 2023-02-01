<?php

namespace App\Http\Controllers\Backsite;

use App\Helpers\ProductHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImportRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function datacard(Request $request)
    {
        return ProductHelper::getProductData($request->all())->paginate(12);
    }

    public function index()
    {
        return view('backsite.product.index');
    }

    public function create()
    {
        return view('backsite.product.create');
    }

    public function store(ProductStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            for($i=0 ; $i<count($request->name) ; $i++) {
                $data['name'] = $request->name[$i];
                $data['category_id'] = $request->category_id[$i];
                $data['quantity'] = $request->quantity[$i] ? $request->quantity[$i] : 0;
                $data['price'] = $request->price[$i] ? $request->price[$i] : 0;
                $new_product = Product::create($data);

                if($request->has('product_image')) {
                    if(array_key_exists($i, $request->product_image)) {
                        $image_name = $request->product_image[$i]->getClientOriginalName();
                        $product_image_name = ProductHelper::getImageName($image_name);
                        $dataImage['product_id'] = $new_product->id;
                        $dataImage['path'] = $request->product_image[$i]->storeAs(
                            '/product/image', $product_image_name, 'public'
                        );
                        ProductImage::create($dataImage);
                    }
                }
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => [$e->getMessage()]
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyimpan data'
        ]);
    }

    public function showdata($id)
    {
        $product = Product::with('category', 'image')->find($id);
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function edit($id)
    {
        return view('backsite.product.edit', compact('id'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            if($request->name) $product->name = $request->name;
            if($request->category_id) $product->category_id = $request->category_id;
            if($request->quantity) $product->quantity = $request->quantity;
            if($request->price) $product->price = $request->price;
            $product->save();
            if($request->has('product_image')) {
                foreach($request->product_image as $image) {
                    $image_name = $image->getClientOriginalName();
                    $product_image_name = ProductHelper::getImageName($image_name);
                    $dataImage['product_id'] = $product->id;
                    $dataImage['path'] = $image->storeAs(
                        '/product/image', $product_image_name, 'public'
                    );
                    ProductImage::create($dataImage);
                }
            }
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => [$e->getMessage()]
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil update data'
        ]);
    }

    public function destroy($id)
    {
        try {
            $product = Product::with('image')->find($id);
            foreach($product->image as $image) {
                $image_path = public_path() . '/storage/' . $image->path;
                if(file_exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $product->delete();
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => [$e->getMessage()]
            ], 422);
        }

        return response()->json([
            'success'  => true,
            'message' => 'Berhasil hapus produk'
        ]);
    }

    public function destroyImage($id) {
        try {
            $image = ProductImage::find($id);
            $image_path = public_path() . '/storage/' . $image->path;
            if(file_exists($image_path)) {
                File::delete($image_path);
            }
            $image->delete();
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => [$e->getMessage()]
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil hapus gambar'
        ]);
    }

    public function import(ProductImportRequest $request)
    {
        $file = $request->file('file');
        $import = new ProductImport;
        Excel::import($import, $file);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil upload data'
        ]);
    }
}
