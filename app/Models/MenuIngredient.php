<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MenuIngredient extends Pivot
{
    use HasFactory;

    protected $table = 'menu_ingredients';

    protected $fillable = [
        'menu_id',
        'ingredient_id',
        'quantity_required',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
} 