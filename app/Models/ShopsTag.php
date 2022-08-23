<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopsTag extends Model
{
    use HasFactory;
    
    protected $fillable = ['tag_id', 'shop_id'];

    public function tag()
    {
        return $this->belongTo(Tag::class);
    }

    public function shop()
    {
        return $this->belongTo(Shop::class);
    }
}
