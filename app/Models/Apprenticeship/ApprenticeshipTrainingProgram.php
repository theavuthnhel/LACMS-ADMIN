<?php

namespace App\Models\Apprenticeship;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ApprenticeshipTrainingProgram extends Model
{
	protected $table = "apprenticeship_training_program";

    protected static $logOnlyDirty = true;

    protected $fillable = [
    	'apprenticeship_id',
        'program_skill',
        'program_theory',
        'program_pratice',
        'program_others',
    ];

    protected static $logAttributes = [
        'apprenticeship_id',
        'program_skill',
        'program_theory',
        'program_pratice',
        'program_others',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Apprenticeship Training Program";
    }
}
