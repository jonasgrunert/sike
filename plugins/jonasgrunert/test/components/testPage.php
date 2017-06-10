<?php
	namespace JonasGrunert\Test\Components;

	use Cms\Classes\ComponentBase;
	use JonasGrunert\Test\Models\Test;

	class testPage extends ComponentBase{
		
		public $test;

		public function componentDetails(){
			return [
				'name' => 'testPage',
				'description' => 'Displaying a rendered test with ajax handlers'
			];
		}

		public function defineProperties(){
	        return [
	            'slug' => [
	                'title'       => 'slug',
	                'description' => 'Identifier of the test placed in the URL',
	                'default'     => '{{ :slug }}',
	                'type'        => 'string'
	            ],
	        ];
	    }

		public function onRun(){
			$this->test = $this->loadTest();
		}

		protected function loadTest(){
			$slug = $this->property('slug');
			$Test = Test::where('slug', $slug)->first();
			return $Test;
		}

		public function onSubmitTest(){
			
		}
	}