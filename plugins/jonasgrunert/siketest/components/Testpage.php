<?php namespace JonasGrunert\Siketest\Components;

use Cms\Classes\ComponentBase;
use JonasGrunert\Siketest\Models\Test;
use JonasGrunert\Siketest\Models\Answer;
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

	public $testtable;
	public $rendertest;
	public $trueanswers;
	protected $helper;

	public function onRun()
	{
		$this->helper = array();
		$this->testtable = $this->getTest();
		$this->rendertest = $this->renderTest($this->testtable);
		$this->trueanswers = $this->trueAnswers($this->helper);
	}

	protected function getTest()
	{
		$slug = $this->property('slug');
		$test = Test::where('slug', $slug)->first();
		return $test;
	}

	protected function renderTest($testinfo){
		$test = array();
		foreach ($testinfo->Questions()->get() as $question){
			array_push($test, $this->chooseAnswers($question));
		}
		return $test;
	}

	protected function trueAnswers($testinfo){
		$true = array();
		for($i =0; $i<count($testinfo); $i++){
			$trueanswers = 0;
			for($j=0; $j<count($testinfo[$i]); $j++){
				if(Answer::where('id', $testinfo[$i][$j])->pluck('result') == 1){
					$trueanswers++;
				}
			}
			array_push($true, $trueanswers);
		}
		return $true;
	}

	protected function chooseAnswers($question)
	{
		$answers_id = array();
		$truearray = array();
		$answerpossibilities = $question->Answers()->lists('id');
		for ($i = 0; $i<4 && $i < count($answerpossibilities); $i++){
			$id = rand(0, count($answerpossibilities)-1);
			if ($this->existsAnswer($answers_id, $id)){
				array_push($answers_id, $id);
				array_push($truearray, $answerpossibilities[$id]);
			} else {
				$i--;
			}
		}
		array_push($this->helper, $truearray);
		return $answers_id;
	}

	protected function existsAnswer($existing, $new)
	{
		for ($i = 0; $i < count($existing); $i++){
			if($existing[$i] == $new){
				return false;
			}
		}
		return true;
	}

	public function onHandIn(){
		$truth = array();
		$supposed = null;
		$oldquestionid = null;
		$questionid = null;
		$currentquestionid = null;
		$totalquestionpoints=0;
		$questionpoints=0;
		$points=0;
		$block= false;
		$input= Input::all();
		foreach ($input as $inputid => $real){
			if(strpos($inputid, "&")== false){
				array_push($truth, $real);
			}
		}
		foreach ($input as $inputid => $real){
			if(strpos($inputid, "&")!= false){
				$questionid = stristr($inputid, "&", true);
				if ($questionid!=$oldquestionid&&$oldquestionid!=null){
					if($block == false){
						$points+=$questionpoints/$totalquestionpoints;
					}
					$block = false;
					$questionpoints=0;
				}
				$answerid = substr(stristr($inputid, "&"),1);
				$supposed = Answer::where('id', intval($answerid))->pluck('result');
				$totalquestionpoints=intval($truth[$questionid]);
				if ($real == "on"){
					$questionpoints++;
				}
				if($supposed == 0 && $real == "on"){
					$block=true;
				}
				$oldquestionid=$questionid;
			}
		}
		if($block == false && $totalquestionpoints != 0){
			$points+=$questionpoints/$totalquestionpoints;
		}
		$totalpoints=count($truth);
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
