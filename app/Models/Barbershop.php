<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barbershop extends Model
{
    protected $table = 'barbershops';
    protected $fillable = ['id', 'name', 'slug', 'cnpj', 'phone', 'color', 'isActive'];
    protected $guarded = [];
}