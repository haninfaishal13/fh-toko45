<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS = [
        'belum_dibayar' => '0',
        'dibayar' => '1'
    ];

    const TYPE = [
        'beli' => '0',
        'jual' => '1'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaction::class);
    }

}
