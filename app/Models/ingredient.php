<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ingredient extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'quantity', 'product_id', 'meal_id'];


 // product

//  public function product(): BelongsTo
//  {
//      return $this->belongsTo(product::class);
//  }
 // meal


}
