<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barbershop extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'barbershops';
    protected $fillable = ['id', 'name', 'slug', 'cnpj', 'phone', 'color', 'isActive'];
    protected $guarded = [];
    public $incrementing = false;
    public $hidden = ['created_at', 'updated_at'];
    public $casts = [
        'id' => 'string',
        'isActive' => 'boolean',
    ];
}