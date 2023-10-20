<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyApiController extends Controller
{
    
    public function store(Survey $survey, Request $request){
        $request->validate([
            'json'  =>  'required',
        ]);

        $result = $survey->results()->create([

            'json'          =>  $request->input('json'),
            'ip_address'    =>  $request->ip(),
        ]);
    }
}
