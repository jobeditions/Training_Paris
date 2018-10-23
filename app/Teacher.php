<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Teacher
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Classe[] $classes
 * @property integer $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereUserId($value)
 * @property integer $school_id
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereSchoolId($value)
 * @property-read \App\School $school
 * @property integer $remaining_invites
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereRemainingInvites($value)
 * @property-read \App\User $data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\School[] $schools
 */
class Teacher extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'school_id'];

    public function classes()
    {
        return $this->belongsToMany('App\Classe')->get();
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function documents()
    {
        //TMP fix
        //return \DB::table("documents")->where("teacher_id", $this->id)->get();

        return $this->hasMany('App\Document')->get();
    }

    public function schools()
    {
        return $this->belongsToMany('App\School');
    }

    public function data()
    {
		return $this->belongsTo('App\User', 'user_id');
    }
}
