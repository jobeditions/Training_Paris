<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Invite
 *
 * @mixin \Eloquent
 * @property string $email
 * @property string $code
 * @property integer $from_id
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Invite whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invite whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invite whereFromId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invite whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invite whereUpdatedAt($value)
 * @property int $free_days
 * @method static \Illuminate\Database\Query\Builder|\App\Invite whereFreeDays($value)
 */
class Invite extends Model
{
    protected $primaryKey = 'code';
}
