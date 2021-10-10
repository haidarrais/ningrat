<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPicture extends Model
{
    use HasFactory;
    protected $table = 'product_pictures';

    protected $fillable = ['product_id', 'image', 'is_important'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
