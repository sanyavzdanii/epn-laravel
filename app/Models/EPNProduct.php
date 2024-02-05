<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EPNProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', // внешний идентификатор товара из API EPN Goods
        'id_category',
        'name',
        'description',
        'img',
        'all_img',
        'prices',
        'price',
        'lowest_price',
        'affiliate_link',
        // Добавьте другие поля, которые вам нужны
    ];

    protected $casts = [
        'all_img' => 'json', // Указываем Laravel, что поле 'images' должно быть приведено к типу JSON
    ];

    protected $primaryKey = 'id'; // Указываем, что внешний идентификатор является первичным ключом

    public $incrementing = false; // Отключаем автоинкремент для внешнего идентификатора

    // Метод для обновления самой низкой цены
    public function updateLowestPrice($price)
    {
        if ($price < $this->lowest_price || $this->lowest_price === null) {
            $this->lowest_price = $price;
            $this->save();
        }
    }
}
