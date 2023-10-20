<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
class Survey extends Model
{
    use HasFactory,AsSource,  UUID, SoftDeletes;

    protected $fillable = [
        'name',
        'user_id'
    ];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany('App\Models\SurveyResult', 'survey_id');
    }


}
