<?php
namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductHelper {
    public static function getProductData($params, $id=0)
    {
        $product = Product::with('category', 'image');
        $where = [];
        if(array_key_exists('filter_category', $params)) $where['category_id'] = $params['filter_category'];
        if(array_key_exists('filter_order_price', $params)) {
            if($params['filter_order_price'] == 1) {
                $product->orderBy('price', 'asc');
            } else {
                $product->orderBy('price', 'desc');
            }
        }
        if(array_key_exists('filter_order_quantity', $params)) {
            if($params['filter_order_quantity'] == 1) {
                $product->orderBy('quantity', 'asc');
            } else {
                $product->orderBy('quantity', 'desc');
            }
        }
        if(array_key_exists('search', $params)) {
            $product->where('name', 'like', '%' . strtolower($params['search']) . '%');
        }
        return $product->where($where);
    }

    public static function getImageName($image_name)
    {
        $code = random_int(0000, 9999);
        $status = true;
        $get_image_name = $code . '-' . $image_name;
        while($status) {
            $path = public_path() . '/storage/product/image/' . $get_image_name;
            if(File::exists($path)) {
                $code = random_int(0000, 9999);
                $get_image_name = $code . '-' . $image_name;
            } else {
                $status = false;
            }
        }

        return $get_image_name;
    }
}
?>
