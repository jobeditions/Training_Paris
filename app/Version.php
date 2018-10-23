<?php
/**
 * Copyright (c) Liigem 2016.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Version
 *
 * @mixin \Eloquent
 * @property float $version_number
 * @property string $update
 * @method static \Illuminate\Database\Query\Builder|\App\Version whereVersionNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Version whereUpdate($value)
 */
class Version extends Model
{
    public $timestamps = false;
}
