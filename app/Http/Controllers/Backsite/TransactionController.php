<?php

namespace App\Http\Controllers\Backsite;

use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStoreRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backsite.transaction.index');
    }

    public function getData(Request $request)
    {
        $where = [];
        $transaction = Transaction::select('id', 'total_price', 'status', 'created_at');
        if($request->has('order_price')) {
            $transaction->orderBy('total_price', $request->order_price);
        }
        if($request->has('order_date')) {
            $transaction->orderBy('created_at', $request->order_date);
        }
        return response()->json([
            'success' => true,
            'message' => 'Berhasil ambil data',
            'data' => $transaction->simplePaginate(12)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionStoreRequest $request)
    {
        $transaction = TransactionHelper::storeTransaction($request);

        return response()->json([
            'success' => $transaction['success'],
            'message' => $transaction['message']
        ], $transaction['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
