<?php

namespace App\Models\Bio;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BioTemp extends Model implements HasMedia
{
	use InteractsWithMedia;

    protected $table = "bio_temp";

    protected $fillable = [
    	"created_by"
    ];

    public function MediaTemp(){
    	return $this->hasMany('Spatie\MediaLibrary\Models\Media', 'model_id');
    }

    public function ScopeMediaTemps($query){
    	// $model_id = $query->id;
    	return $query->whereHas('media', function($media){
    		$media->where('model_type', 'App\Models\Bio\BioTemp');
    	});
    }
}
