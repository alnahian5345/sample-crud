<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model{
    protected $table="products";
    protected $primaryKey="id";
    public $timestamps = false;

    protected $fillable = [
        'name',
        'sku',
        'current_stock',
        'price',
        'cost_price'
    ];


}
