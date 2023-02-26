<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use \Sushi\Sushi;

    protected $rows = [
        [
            'name' => 'Builder Suppiler',
            'mobile' => '2348128804466',
            'address' => '7a Adebayo Close, Amikale',
            'city' => 'Alagbado',
            'state' => 'Lagos',
            'zip' => '23401',
            'country' => 'Nigeria',
            'min' => 10000.00,
            'free' => 10000.00,
            'tax' => 15.00,
            'shipping' => 'Truck',
            'shippingPrice' => 40.00,
            'status' => 1,
            'created_at' => 2023-02-16,
            'updated_at' => 2023-02-16,
        ],
    ];

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'min',
        'free',
        'tax',
        'shipping',
        'shippingPrice',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];
}
