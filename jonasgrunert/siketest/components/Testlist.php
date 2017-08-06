<?php namespace JonasGrunert\Siketest\Components;

use Cms\Classes\ComponentBase;
use JonasGrunert\Siketest\Models\Test;
use Cms\Classes\Page;

class Testlist extends ComponentBase
{
	public function componentDetails()
	{
		return [
			'name' => 'Test List',
			'description' => 'Displays all Tests'
		];
	}

	public function defineProperties()
	{
		return [
			'testpage' => [
				'title' => 'Test Page',
				'description' => 'Link to the test page',
				'type' => 'dropdown'
			]
		];
	}

	public function getTestpageOptions(){
		return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
	}

	public function onRun(){
		$this->tests = $this->page['tests'] = $this->generateTestList();
	}

	protected function generateTestList(){
		$tests = Test::all();
		$tests->each(function($test){
			$test->url = $this->property('testpage').'/'.$test->slug;
		});
		return $tests;
	}
}