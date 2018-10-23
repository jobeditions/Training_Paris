<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

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
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereClassId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereDueDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereOptional($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Assignment whereUpdatedAt($value)
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
 * @property bool $surprise
 * @method static \Illuminate\Database\Query\Builder|\App\Exam whereSurprise($value)
 */
class Exam extends Model
{
    //
    public $timestamps = false ;
    protected $table = 'exams';
}
