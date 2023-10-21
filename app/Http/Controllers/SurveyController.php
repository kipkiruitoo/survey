<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Survey;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Survey $survey)
    {
        // dd($survey);
        //
        return Inertia::render('Surveys/Create', [
            'structure' => $survey->structure,
            'surveyid'=> (String) $survey->id,
            'name' => $survey->name,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        return Inertia::render('Surveys/Show', [
            'structure' => $survey->structure,
            'surveyid'=> (String) $survey->id,
            'name' => $survey->name,
        ]);
    }

    public function visualize(Survey $survey)
    {
        $results = $survey->results()->get()->pluck('json')->map(function ($result){
            return json_decode($result);
        })->toArray();

        // foreach ($results as $key => $result) {
            
        //     $results[$key] = json_decode($result); 
        //     // dd($results[$key]);
        // }


        return Inertia::render('Surveys/Visualize', [
            'results' => json_encode($results),
            'structure' => $survey->structure,
            'surveyid'=> (String) $survey->id,
            'name' => $survey->name,
        ]);
    }


   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
