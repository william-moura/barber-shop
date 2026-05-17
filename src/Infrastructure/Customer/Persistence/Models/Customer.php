<?php

namespace Src\Infrastructure\Customer\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'document',
    ];
}