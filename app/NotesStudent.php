<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NotesStudent
 *
 * @property int $id
 * @property float $note
 * @property int $note_ref
 * @property int $student_id
 * @method static \Illuminate\Database\Query\Builder|\App\NotesStudent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NotesStudent whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NotesStudent whereNoteRef($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NotesStudent whereStudentId($value)
 * @mixin \Eloquent
 */
class NotesStudent extends Model
{
    public $timestamps = false;
    protected $table = 'notes_students';
}
