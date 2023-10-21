<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyApiController extends Controller
{
    
    public function store(Survey $survey, Request $request){
        $request->validate([
            'uuid' => 'required|unique:survey_results,id',
            'json'  =>  'required',
        ]);

        $result = $survey->results()->create([

            'uuid' =>  $request->input('uuid'),
            'json'          =>  $request->input('json'),
            'survey_id' => $request->input($survey->id),
            'ip_address'    =>  $request->ip(),
        ]);
    }
}
