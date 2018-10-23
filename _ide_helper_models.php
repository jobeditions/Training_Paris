<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AssignmentDocument[] $documents
 * @property-read mixed $author
 * @property-read mixed $classe_name
 * @property-read mixed $done
 * @property-read mixed $last_due_date
 * @property-read mixed $late
 * @property-read mixed $over
 */
	class Assignment extends \Eloquent {}
}

namespace App{
/**
 * App\AssignmentDocument
 *
 * @property int $id
 * @property int $student_id
 * @property int $assignment_id
 * @property string $path
 * @property string $type
 * @property string $uploaded_at
 * @property int $plagiarism
 * @property-read \App\Assignment $assignment
 * @property-read \App\Classe $classe
 * @property-read mixed $classe_name
 * @property-read mixed $name
 * @property-read \App\Student $student
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereAssignmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument wherePlagiarism($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AssignmentDocument whereUploadedAt($value)
 */
	class AssignmentDocument extends \Eloquent {}
}

namespace App{
/**
 * App\Classe
 *
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 */
	class Classe extends \Eloquent {}
}

namespace App{
/**
 * App\Document
 *
 * @mixin \Eloquent
 * @property integer $teacher_id
 * @property string $path
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document wherePath($value)
 * @property integer $id
 * @property integer $assignment_id
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereAssignmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereCreatedAt($value)
 * @property string $type
 * @property integer $class_id
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereClassId($value)
 */
	class Document extends \Eloquent {}
}

namespace App{
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
	class Exam extends \Eloquent {}
}

namespace App{
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
	class Invite extends \Eloquent {}
}

namespace App{
/**
 * App\School
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_headmaster
 * @property boolean $headmaster_pays
 * @method static \Illuminate\Database\Query\Builder|\App\School whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereIdHeadmaster($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereHeadmasterPays($value)
 * @mixin \Eloquent
 * @property string $city_name
 * @property integer $headmaster_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @method static \Illuminate\Database\Query\Builder|\App\School whereCityName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\School whereHeadmasterId($value)
 */
	class School extends \Eloquent {}
}

namespace App{
/**
 * App\Student
 *
 * @property integer $id
 * @property string $name
 * @property int $user_id
 * @property int $school_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Classe[] $classes
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Student whereSchoolId($value)
 * @mixin \Eloquent
 * @property-read mixed $classes_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $documents
 * @property mixed $current_assignment
 * @property-read mixed $last_name
 * @property-read mixed $last_updated
 * @property-read mixed $late
 * @property-read mixed $uploaded
 */
	class Student extends \Eloquent {}
}

namespace App{
/**
 * App\Teacher
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Classe[] $classes
 * @property integer $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereUserId($value)
 * @property integer $school_id
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereSchoolId($value)
 * @property-read \App\School $school
 * @property integer $remaining_invites
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereRemainingInvites($value)
 * @property-read \App\User $data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\School[] $schools
 */
	class Teacher extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $rank
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @property string $stripe_id
 * @property string $card_brand
 * @property string $card_last_four
 * @property \Carbon\Carbon $trial_ends_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStripeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCardBrand($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTrialEndsAt($value)
 * @property string $last_name
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @property string $avatar
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatar($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Version
 *
 * @mixin \Eloquent
 * @property float $version_number
 * @property string $update
 * @method static \Illuminate\Database\Query\Builder|\App\Version whereVersionNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Version whereUpdate($value)
 */
	class Version extends \Eloquent {}
}

