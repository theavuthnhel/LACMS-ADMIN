<?php

namespace App\Models\Apprenticeship;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ApprenticeshipTrainingTeacher extends Model
{
    protected $table = "apprenticeship_training_teacher";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'apprenticeship_id',
        'teacher_name',
        'teacher_gender',
        'teacher_dob',
        'teacher_skill',
        'teacher_education',
        'teacher_graduated_school',
        'teacher_graduated_date',
        'teacher_experience',
        'teacher_previous_working_place',
        'teacher_teaching_skill',
    ];

    protected static $logAttributes = [
        'apprenticeship_id',
        'teacher_name',
        'teacher_gender',
        'teacher_dob',
        'teacher_skill',
        'teacher_education',
        'teacher_graduated_school',
        'teacher_graduated_date',
        'teacher_experience',
        'teacher_previous_working_place',
        'teacher_teaching_skill',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Apprenticeship Training Teacher";
    }
}
