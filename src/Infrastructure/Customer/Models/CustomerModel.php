<?php

namespace Src\Infrastructure\Customer\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerModel extends Model
{
    use HasUlids, HasFactory, SoftDeletes;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'phone_number',
        'document',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
}