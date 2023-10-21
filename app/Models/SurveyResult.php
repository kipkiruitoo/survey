<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyResult extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'id',
        'json',
        'survey_id',
        'ip_adress'
      
    ];
    
}
