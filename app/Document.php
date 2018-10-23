<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Document
 *
 * @mixin \Eloquent
 * @property integer $teacher_id
 * @property string $path
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document wherePath($value)
 * @property integer $id
 * @property integer $assignment_id
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereAssignmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereCreatedAt($value)
 * @property string $type
 * @property integer $class_id
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereClassId($value)
 * @property-read \App\Assignment $assignment
 * @property-read mixed $classe_name
 * @property-read mixed $name
 */
class Document extends Model
{
	public function assignment()
	{
		return $this->belongsTo('App\Assignment');
	}

	public function getNameAttribute()
	{
		return preg_replace("/[0-9]*_[0-9]*_/i", "", $this->path, 1);
	}
	public function getClasseNameAttribute()
	{
		return \App\Classe::find($this->class_id)->name;
	}
}
