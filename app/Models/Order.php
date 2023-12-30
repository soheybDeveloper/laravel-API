<?php
// app/Models/Order.php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



    class Order extends Model
    {
        public $table="orders";
        protected $fillable = ['title', 'description', 'price',
//            'status'
        ];
        protected $casts = [

            'status' => OrderStatus::class
        ];


        // Relationships
        public function user():BelongsTo
        {
            return $this->belongsTo(User::class,'user_id');
        }


        public function scopeFilter($query)
        {
            if (request('title'))
                $query->where('title', 'like', '%' . request('title') . '%');

            return $query;
        }

    }
