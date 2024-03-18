<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PhpParser\Node\Expr\FuncCall;

class Food extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('amount')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
