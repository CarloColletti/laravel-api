<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'brand',
    'size',
    'price',
    'type',
    'img',
  ];

  protected function getUpdatedAtAttribute($value) {
    return date('d/m/Y H:i:s', strtotime($value));
  }

  public function getImage() {
      return $this->img ? asset("storage/" . $this->img) : "https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg";
  }
}
