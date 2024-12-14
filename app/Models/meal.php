<?php

namespace App\Models;

use App\Models\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class meal extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }
}
