<?php
	namespace JonasGrunert\Aboutus\Components;

	use Cms\Classes\ComponentBase;
	use JonasGrunert\Aboutus\Models\Member;

	class Members extends ComponentBase{
		
		public function componentDetails(){
			return [
				'name' => 'Member Page',
				'description' => 'Displaying all members in a grid with modals'
			];
		}

		public function onRun(){
			$this->members = $this->loadMembers(); 
		}

		protected function loadMembers(){
			return Member::all();
		}

		public $members;
	}