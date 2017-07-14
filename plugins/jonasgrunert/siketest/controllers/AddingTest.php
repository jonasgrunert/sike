<?php namespace JonasGrunert\Siketest\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class AddingTest extends Controller
{
    public $implement = ['Backend.Behaviors.FormController', 'Backend.Behaviors.RelationController'];
    
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'jonasgrunert.siketest.edit_tests' 
    ];

    protected $answerFormWidget;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('JonasGrunert.Siketest', 'test', 'addingtest');
        $this->answerFormWidget = $this->createAnswerFormWidget();
    }

    public function onLoadCreateAnswerForm()
    {
        $this->vars['answerFormWidget'] = $this->answerFormWidget;

        $this->vars['questionId'] = post('manage_id');

        return $this->makePartial('answer_create_form');
    }

    public function onCreateAnswer()
    {
        $data = $this->answerFormWidget->getSaveData();

        $model = new \JonasGrunert\Siketest\Models\Answer;

        $model->fill($data);

        $model->save();

        $question = $this->getQuestionModel();

        $question->Answers()->add($model, $this->answerFormWidget->getSessionKey());

        return $this->refreshAnswerList();
    }

    public function onDeleteAnswer()
    {
        $recordId = post('record_id');

        $model = \JonasGrunert\Siketest\Models\Answer::find($recordId);

        $question = $this->getQuestionModel();

        $question->Answers()->remove($model, $this->answerFormWidget->getSessionKey());

        return $this->refreshAnswerList();
    }

    protected function refreshAnswerList()
    {
        $answers = $this->getQuestionModel()
            ->Answers()
            ->withDeferred($this->answerFormWidget->getSessionKey())
            ->get()
        ;

        $this->vars['answers'] = $answers;

        return ['#answerList' => $this->makePartial('answer_list')];
    }

    protected function getQuestionModel()
    {
        $questionId = post('manage_id');

        $question = $questionId
            ? \JonasGrunert\Siketest\Models\Question::find($questionId)
            : new \JonasGrunert\Siketest\Models\Question;

        return $question;
    }

    protected function createAnswerFormWidget()
    {
        $config = $this->makeConfig('$/jonasgrunert/siketest/models/answer/fields.yaml');

        $config->alias = 'answerForm';

        $config->arrayName = 'Answers';

        $config->model = new \JonasGrunert\Siketest\Models\Answer;

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);

        $widget->bindToController();

        return $widget;
    }
}