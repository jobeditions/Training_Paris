<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\School
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_headmaster
 * @property boolean $headmaster_pays
 * @method static \Illuminate\Database\Query\Builder|\App\School whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereIdHeadmaster($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereHeadmasterPays($value)
 * @mixin \Eloquent
 * @property string $city_name
 * @property integer $headmaster_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @method static \Illuminate\Database\Query\Builder|\App\School whereCityName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereHeadmasterId($value)
 */
class School extends Model
{
    public $timestamps = false;

    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }

    public function admins()
    {
        return $this->hasMany('App\Admin');
    }

    public function classrooms()
    {
        return $this->hasMany('App\Classe')->get();
    }
}
