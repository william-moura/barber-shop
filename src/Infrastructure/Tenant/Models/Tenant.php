<?php

namespace App\Infrastructure\Tenant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Tenant extends Model
{
    use HasUlids, HasFactory, SoftDeletes;
    protected $table = 'tenants';
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'document',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'website',
        'logo',
        'favicon',
        'status',
        'trial_ends_at',
    ];
    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];
}