<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MissingStudent
 *
 * @property int $id
 * @property int $call_ref
 * @property int $student_id
 * @property string $type_absence
 * @property bool $justified
 * @property string $justification_info
 * @property string $absence_start
 * @property string $absence_end
 * @property string $last_edit
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereAbsenceEnd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereAbsenceStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereCallRef($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereJustificationInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereJustified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereLastEdit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MissingStudent whereTypeAbsence($value)
 * @mixin \Eloquent
 */
class MissingStudent extends Model
{
    public $timestamps = false;
    protected $table = 'absence_student';
}
