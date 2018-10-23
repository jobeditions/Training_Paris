<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Actuality
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $author
 * @property string $start_date
 * @property string $end_date
 * @property bool $visible
 * @method static \Illuminate\Database\Query\Builder|\App\Actuality whereAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Actuality whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Actuality whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Actuality whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Actuality whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Actuality whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Actuality whereVisible($value)
 * @mixin \Eloquent
 */
class Actuality extends Model
{
    public $timestamps = false;
    protected $table = 'newsfeed';
}
