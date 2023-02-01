<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backsite.dashboard.index');
    }

    public function getData()
    {
        $category_count = Category::count();
        $product_count = Product::count();
        $user_count = User::count();
        $transaction_count = Transaction::count();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan data',
            'data' => [
                'category' => $category_count,
                'product' => $product_count,
                'user' => $user_count,
                'transaction' => $transaction_count
            ]
        ]);
    }

    public function getStatistic(Request $request)
    {
        $year = date('Y');
        $month = date('m');

        $array_month = [];
        for ($m=1; $m<=12; $m++) {
            $month_name = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $array_month[] = $month_name;
        }

        $transaction = Transaction::with('detail.product')->where('user_id', Auth::id());

        if($request->has('year')) {
            $transaction_all = $transaction->whereYear('created_at', $request->year)->get();
        } else {
            $transaction_all = $transaction->whereYear('created_at', $year)->get();
        }

        if($request->has('month')) {
            $transaction_product_month = $transaction->whereMonth('created_at', $request->month)->get();
        } else {
            $transaction_product_month = $transaction->whereMonth('created_at', $month)->get();
        }

        $arr_detail_transaction = [];
        for($i=1 ; $i<=12 ; $i++) {
            $start_date = date('Y-m-d', strtotime($year.'-'.$i.'-1'));
            $finish_date = date('Y-m-t', strtotime($year.'-'.$i.'-1'));

            $tmp['month'] = $i;
            $tmp['count'] = $transaction_all->whereBetween('created_at', [$start_date." 00:00:00", $finish_date." 00:00:00"])->count();
            $tmp['total_income'] = $transaction_all->whereBetween('created_at', [$start_date." 00:00:00", $finish_date." 00:00:00"])->sum('total_price');

            $arr_detail_transaction[] = $tmp;
        }

        $arr_detail = [];
        foreach($transaction_product_month as $tpm) {
            foreach($tpm->detail as $detail) {
                $tmp['name'] = $detail->product->name;
                $tmp['quantity'] = $detail->quantity;
                if(count($arr_detail) == 0) {
                    $arr_detail[] = $tmp;
                } else {
                    $check_exist = false;
                    for($i=0 ; $i<count($arr_detail) ; $i++) {
                        if($arr_detail[$i]['name'] == $detail->product->name) {
                            $arr_detail[$i]['quantity'] += $detail->quantity;
                            $check_exist = true;
                        }
                    }
                    if(!$check_exist) {
                        $arr_detail[] = $tmp;
                    }
                }
            }
        }
        return response()->json([
            'success' => true,
            'data' => [
                'transaction_total' => $arr_detail_transaction,
                'transaction_product_permonth' => $arr_detail
            ]
        ]);
    }

}
