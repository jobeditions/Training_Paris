<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Assignment
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $teacher_id
 * @property integer $class_id
 * @property string $name
 * @property string $content
 * @property string $due_date
 * @property boolean $optional
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereClassId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereDueDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereOptional($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereCreatedAt($value)
 * @property boolean $allow_uploading
 * @property integer $allow_delaying
 * @property integer $max_files
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereAllowUploading($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereAllowDelaying($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereMaxFiles($value)
 * @property int $classe_id
 * @property-read \App\Teacher $teacher
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Classe[] $classes
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereClasseId($value)
 * @property-read \App\Classe $classe
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Document[] $documents
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AssignmentDocument[] $files
 * @property-read mixed $author
 * @property-read mixed $classe_name
 * @property-read mixed $done
 * @property-read mixed $done_by_student
 * @property-read mixed $last_due_date
 * @property-read mixed $late
 * @property-read mixed $over
 * @property-read mixed $todo
 */
class Assignment extends Model
{
    //
	public $timestamps = false;
    protected $table = 'assignments';

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

	public function files()
    {
        return $this->hasMany('App\AssignmentDocument');
    }

	public function getAuthorAttribute()
	{
		//  return $this->teacher->data->name[0] . ". " . $this->teacher->data->last_name;
    }

	public function getDoneAttribute()
	{
		return count($this->files);
	}

	public function getClasseNameAttribute()
	{
		return $this->classe->name;
    }

	public function documents()
	{
		return $this->hasMany('App\Document');
    }

	public function classe()
	{
		return $this->belongsTo('App\Classe');
    }

	public function getTodoAttribute()
	{
		return true;
	}

	public function getLateAttribute()
	{
        $date = new DateTime($this->due_date);
		return new DateTime() > $date;
    }

	public function getOverAttribute()
	{
        $date = new DateTime($this->due_date);
        $date->add(new DateInterval("P" . $this->allow_delaying . "D"));
		return new DateTime() > $date;
    }

	public function getLastDueDateAttribute()
	{
        $date = new DateTime($this->due_date);
        $date->add(new DateInterval("P" . $this->allow_delaying . "D"));
        return $date->format('Y-m-d H:i:s');
    }

	public function getDoneByStudentAttribute() {
		return false;
		return DB::table("assignments_status")->where([["student_id", "=", $value], ["assignment_id", $this->id]])->exists();
	}

}
