<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  public $timestamps = false;

  protected $fillable = ['user_id', 'school_id'];

  public function schools()
  {
      return $this->hasMany('App\School');
  }

  public function data()
  {
      return $this->belongsTo('App\User', 'user_id');
  }
}
