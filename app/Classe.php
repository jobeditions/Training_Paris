<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Relations\Pivot;

/**
 * App\Classe
 *
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 */
class Classe extends Model
{
    public $timestamps = false;

    public function teachers()
    {
        return $this->belongsToMany('App\Teacher');
    }

    //Une classes a plusieurs étudiants
	public function getStudentsAttribute()
	{
        $ids = \DB::table("classe_student")->join("classes", "classes.id", "=", "classe_student.classe_id")->join("students", "students.id", "=", "classe_student.student_id")->where("classe_id", $this->id)->distinct()->get()->pluck("student_id")->toArray();
        return \App\Student::find($ids);
        //return $this->hasMany("App\Student", 'classe_id', 'student_id');
	}

    //Une classe a plusieurs devoirs
	public function assignments()
	{
		return $this->hasMany('App\Assignment');
	}
}
