<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Student
 *
 * @property integer $id
 * @property string $name
 * @property int $user_id
 * @property int $school_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Classe[] $classes
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereSchoolId($value)
 * @mixin \Eloquent
 * @property-read mixed $classes_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $documents
 * @property-read mixed $avatar
 * @property mixed $current_assignment
 * @property-read mixed $last_name
 * @property-read mixed $last_updated
 * @property-read mixed $late
 * @property-read mixed $uploaded
 * @property-read mixed $uploaded_documents
 */
class Student extends Model
{
	//Désactivation des colonnes created_at et updated_at
	public $timestamps = false;
	private $current_assignment_value;

	//Un étudiant appartient à plusieurs classes

	public function getClassesIdAttribute()
	{
		$classes_id = [];
		foreach ($this->classes() as $classe)
		{
			array_push($classes_id, $classe->id);
		};
		return $classes_id;
	}

	public function classes()
	{
		return $this->belongsToMany('App\Classe');
	}

	public function teachers()
	{
		$teachers = [];
		foreach ($this->classes() as $classe)
		{
			array_push($teachers, $classe->id);
		};
		return $teachers;
	}

	public function review()
	{
		
		return $this->hasOne('App\Review');
	}

	public function assignments()
	{
		$assignments = [];
		foreach ($this->classes as $classe)
		{
			foreach ($classe->assignments as $assignment)
			{
				array_push($assignments, $assignment);
			}
		};
		return $assignments;
	}

	public function documents()
	{
		return $this->hasMany('App\Assignment');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	

	public function setCurrentAssignmentAttribute($value)
	{
		$this->current_assignment_value = $value;
	}

	public function getCurrentAssignmentAttribute()
	{
		return $this->current_assignment_value;
	}

	public function getUploadedAttribute()
	{
		return $this->getUp()->count();
	}

	private function getUp()
	{
		if (is_null($this->up))
		{
			$this->up = \App\AssignmentDocument::where([["student_id", $this->id], ["assignment_id", $this->current_assignment->id]])->get();
		}
		return $this->up;
	}

	public function getUploadedDocumentsAttribute()
	{
		return $this->getUp();
	}

	public function getLastUpdatedAttribute()
	{
		return $this->uploaded ? \App\AssignmentDocument::where([["student_id", $this->id], ["assignment_id", $this->current_assignment->id]])->latest("uploaded_at")->first()->uploaded_at : null;
	}

	public function getLateAttribute()
	{
		return $this->uploaded ? \App\AssignmentDocument::where([["student_id", $this->id], ["assignment_id", $this->current_assignment->id]])->whereDate("uploaded_at", ">=", $this->current_assignment->due_date)->count() : true;
	}

	public function getNameAttribute()
	{
		return $this->user->name;
	}

	public function getLastNameAttribute()
	{
		return $this->user->last_name;
	}

    public function getAvatarAttribute()
    {
		return $this->user->avatar;
    }
}
