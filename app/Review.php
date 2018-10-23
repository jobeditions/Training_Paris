<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Actuality
 *
 */
class Review extends Model
{
    protected $fillable = ['item'];
     public function student()
    {
		return $this->belongsTo('App\Student');
    }

}
