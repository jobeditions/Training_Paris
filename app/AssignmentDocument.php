<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AssignmentDocument
 *
 * @property int $id
 * @property int $student_id
 * @property int $assignment_id
 * @property string $path
 * @property string $type
 * @property string $uploaded_at
 * @property string $meyenii
 * @property-read \App\Assignment $assignment
 * @property-read \App\Classe $classe
 * @property-read mixed $classe_name
 * @property-read mixed $name
 * @property-read mixed $size
 * @property-read \App\Student $student
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereAssignmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereMeyenii($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereUploadedAt($value)
 * @mixin \Eloquent
 */
class AssignmentDocument extends Model
{
    //
	public $timestamps = false;
    protected $table = 'assignments_documents';

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

	public function getNameAttribute()
	{
		return preg_replace("/[0-9]*_[0-9]*_/i", "", $this->path, 1);
    }

	public function getSizeAttribute()
	{
		return $this->formatBytes(Storage::size("uploaded/students/" . $this->path));
	}

	private function formatBytes($size, $precision = 1)
	{
		//Retourne la taille formattée de façon lisible
		$base = log($size, 1024);
		$suffixes = array('', 'K', 'M', 'G', 'T');
		return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
	}

	public function getClasseNameAttribute()
	{
        return $this->classe->name;
    }

	public function classe()
	{
		return $this->belongsTo('App\Classe');
    }

}
