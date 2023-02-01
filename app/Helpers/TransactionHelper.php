<?php
namespace App\Helpers;

use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionHelper {
    public static function storeTransaction($request)
    {
        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total_price' => $request->total_price,
                'status' => $request->status
            ]);
            $tr_code = 'T-' . date('Ymd') . '-' . $transaction->id;
            $transaction->transaction_code = $tr_code;
            $transaction->save();

            $count = count($request->product_id);
            for($i=0 ; $i<$count ; $i++) {
                $product_id = $request->product_id[$i];
                $quantity = $request->quantity[$i];
                DetailTransaction::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product_id,
                    'quantity' => $quantity
                ]);
                $product = Product::find($product_id);
                $product->quantity = $product->quantity - $quantity;
                $product->save();
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => [$e->getMessage()],
                'status' => 422
            ];
        }
        return [
            'success' => true,
            'message' => 'Berhasil menyimpan transaksi',
            'status' => 200
        ];
    }
}
?>
