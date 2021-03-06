<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  protected $fillable = [
    'name', 'region_id',
  ];

  public function store()
  {
    return $this->hasMany(store::class);
  }

  public function store_id()
  {
    return $this->store->pluck('id');
  }

  public function user()
  {
    return $this->hasMany(User::class);
  }

  public function user_id()
  {
    return $this->user->pluck('id');
  }

  public function product()
  {
    return $this->hasMany(User::class);
  }

  public function product_id()
  {
    return $this->product->pluck('id');
  }

  public function region()
  {
    return $this->belongsTo(Region::class);
  }

  public function region_id()
  {
    return $this->region->id;
  }

  public function name_id()
  {
    return City::pluck('name', 'id');
  }

}
