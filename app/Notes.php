<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Notes
 *
 * @property int $id
 * @property string $title
 * @property float $coefficient
 * @property float $bareme
 * @property string $type
 * @property float $average
 * @property float $mediane
 * @property int $class_id
 * @property int $matiere
 * @property string $add_date
 * @property string $publish_date
 * @property int $period
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereAddDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereAverage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereBareme($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereClassId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereCoefficient($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereMatiere($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereMediane($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes wherePeriod($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes wherePublishDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notes whereType($value)
 * @mixin \Eloquent
 */
class Notes extends Model
{
    public $timestamps = false;
    protected $table = 'notes';
}
