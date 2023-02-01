<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backsite.category.index');
    }
    public function getData(Request $request)
    {
        $number_perpage = $request->has('perpage') ? $request->perpage : 10;
        $category = Category::where('section', 'toko');
        if($request->has('search')) {
            $category->where('name', 'ilike', '%'.strtolower($request->search).'%');
        }
        return $category->simplePaginate($number_perpage);

    }
    public function store(CategoryStoreRequest $request) {
        try {
            $data['category_code'] = $request->category_code;
            $data['name'] = $request->name;
            $data['section'] = $request->section;
            Category::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil simpan kategori'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => [$e->getMessage()]
            ]);
        }
    }

    // public function import(Request $request)
    // {
    //     $file = $request->file('file');
    //     $import = new
    // }
}
