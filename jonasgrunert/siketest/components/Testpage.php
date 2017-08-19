<?php namespace JonasGrunert\Siketest\Components;

use Cms\Classes\ComponentBase;
use JonasGrunert\Siketest\Models\Test;
use JonasGrunert\Siketest\Models\Question;
use JonasGrunert\Siketest\Models\Answer;
use Redirect;
use Input;

class Testpage extends ComponentBase
{
	public function componentDetails()
	{
		return [
			'name' => 'Test Page',
			'description' => 'Displays a Test Form'
		];
	}

	public function defineProperties()
	{
		return [
			'slug' => [
				'title' => 'Slug',
				'description' => 'Slug to identify the test',
				'default' => ':slug',
				'type' => 'string',
				'required' => true
			]
		];
	}

	public $test;
	public $questions;
	public $questionids;
	public $answers;
	public $trueamount;

	public function onRun()
	{
		$this->test = $this->getTest();
		if (!isset($this->test)){
			return Redirect::to('/test');
		}else{
			$this->renderTest();
		}
	}

	protected function getTest()
	{
		$slug = $this->property('slug');
		$test = Test::where('slug', $slug)->first();
		return $test;
	}

	protected function renderTest(){
		$testid = $this->test->id;
		$this->questions = Question::where('test_id', $testid)->get();
		$this->questionids = Question::where('test_id', $testid)->lists('id');
		$this->trueamount = array();
		$this->answers = array();
		for ($i = 0; $i<count($this->questionids); $i++){
			$this->selectAnswers($this->questionids[$i]);
		}
	}

	protected function selectAnswers($question){
		$true = $this->randomize($question);		
		array_push($this->trueamount, $true);
		$trueanswers = Answer::where('question_id', $question)->where('result', 1)->get();
		$falseanswers = Answer::where('question_id', $question)->where('result', 0)->get();
		$helper = array_merge($this->getAnswers($trueanswers->toArray(), $true), $this->getAnswers($falseanswers->toArray(), 5-$true));
		shuffle($helper);
		array_push($this->answers, $helper);
	}

	protected function getAnswers($answers, $amount){
		$helper = array();
		$helperid = array();
		for ($i=0; $i< $amount; $i++){
			$id = rand(0, count($answers)-1);
			if (!in_array($id, $helperid)){
				array_push($helper, $answers[$id]);
				array_push($helperid, $id);
			}else{
				$i--;
			}
		}
		return $helper;
	}

	protected function randomize($question){
		$amount = Answer::where('question_id', $question)->where('result', 1)->count();
		$top = $amount;
		if ($top>4){
			$top=4;
		}
		return rand(1,$top);
	}

	public function onHandIn(){
		$testid = Input::get('testid');
		$test = Test::where('id', $testid)->first();
		$points = 0;
		foreach ($test->Questions as $question){
			$block = false;
			$questionpoints = Input::get(strval($question->id));
			$realquestionpoints = 0;
			foreach ($question->Answers as $answer){
				if($block == false){
					if (null !== (Input::get(strval($question->id)."&".strval($answer->id)))){
						if($answer->result==0){
							$block = true;
						}else{
							$realquestionpoints++;
						}
					}
				}
			}
			if($block==false){
				if ($questionpoints==0){
					$points++;
				} else {
					$points += ($realquestionpoints/$questionpoints);
				}
			}
		}
		$totalpoints=Input::get('trueamount');
		$percentage=$points/$totalpoints;
		$type = "error";
		$message = "Something went wrong";
		if($totalpoints !=0){
			if ($percentage<0.6){
				$message="You failed.";
			} elseif ($percentage<0.9) {
				$type="warning";
				$message="You passed. But you should improve.";
			} else {
				$type = "success";
				$message ="You passed with bravour.";
			}
		}
		$result = array(
			"message" => $message,
			"points" => number_format($points,2),
			"percentage" => number_format($percentage*100,2),
			"type" => $type);
		return $result;
	}
}
