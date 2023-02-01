<?php

namespace App\Http\Controllers\Frontsite;

use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStoreRequest;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        return view('frontsite.transaction.index');
    }

    public function store(TransactionStoreRequest $request)
    {
        $transaction = TransactionHelper::storeTransaction($request);

        return response()->json([
            'success' => $transaction['success'],
            'message' => $transaction['message']
        ], $transaction['status']);

    }
}
