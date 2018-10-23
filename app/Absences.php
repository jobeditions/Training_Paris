<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Absences
 *
 * @property int $id
 * @property int $class_id
 * @property int $user
 * @property string $date_validation
 * @method static \Illuminate\Database\Query\Builder|\App\Absences whereClassId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Absences whereDateValidation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Absences whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Absences whereUser($value)
 * @mixin \Eloquent
 */
class Absences extends Model
{
    public $timestamps = false;
    protected $table = 'appel_en_classe';
}
