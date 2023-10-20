<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Survey;
use Orchid\Screen\Actions\ModalToggle;

use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Inertia\Inertia;

// use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\Menu;
// use App\Models\Task;
use Illuminate\Http\Request;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;


class SurveyScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'surveys' => Survey::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'SurveyScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {     return [
        ModalToggle::make('Add Survey')
            ->modal('surveyModal')
            ->method('create')
            ->icon('plus'),
    ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('surveys', [
                TD::make('name'),
                TD::make('Actions')
                    ->alignRight()
                    ->render(function (Survey $survey) {
                        return Button::make('Delete Survey')
                            ->confirm('After deleting, the survey and all results will be gone forever.')
                            ->method('delete', ['survey' => $survey->id])->icon('bin');
                    }) ,
                     TD::make('Actions')
                    ->alignRight()
                    ->render(function (Survey $survey) {
                        return Menu::make('Script')->url('https://test.survey/admin/surveys/create/' . $survey->id)->icon('pencil');
                    }),
            ]),
            Layout::modal('surveyModal', Layout::rows([
                Input::make('survey.name')
                    ->title('Name')
                    ->placeholder('Enter survey name')
                    ->help('The name of the survey to be created.'),
            ]))
                ->title('Create Survey')
                ->applyButton('Add Survey'),
        ];
    }


        /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function create(Request $request)
    {
        // Validate form data, save task to database, etc.
        $request->validate([
            'survey.name' => 'required|max:255',
        ]);

        $survey = new Survey();
        $survey->name = $request->input('survey.name');
        $survey->user_id = 1;
        $survey->structure = "{}";
        $survey->save();
    }


    /**
     * @param Task $task
     *
     * @return void
     */
    public function delete(Survey $survey)
    {
        $survey->delete();
    }

       /**
     * @param Task $task
     *
     * @return void
     */
    public function script(Survey $survey)
    {
        return Inertia::render('Surveys/Create', [
            'structure' => $survey->structure,
            'surveyid'=> (String) $survey->id,
            'name' => $survey->name,
        ]);
    }
}
