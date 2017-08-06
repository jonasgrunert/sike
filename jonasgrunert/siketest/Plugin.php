<?php namespace JonasGrunert\Siketest;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails(){
    	return [
    		"name" => "Sike Test",
    		"description" => "A nice small plugin to render randomized front end multiple choice tests",
    		"author" => "Jonas Grunert",
    		"icon" => "oc-icon-question"
    	];
    }

    public function registerNavigation(){
    	return [
    		"test" => [
    			"label" => "Test",
    			"url"=> Backend::url('jonasgrunert/siketest/test'),
    			"icon" => "icon-question",
    			"permissions" => ["jonasgrunert.siketest.*"],

    			"sideMenu" => [
    				"newtest" => [
    					"label" => "New Test",
    					"url" => Backend::url('jonasgrunert/siketest/addingtest/create'),
    					"icon" => "icon-plus",
    					"permissions" => ["jonasgrunert.siketest.edit_tests"]
    				],
                    "edit" => [
                        "label" => "Edit Tests",
                        "url" => Backend::url('jonasgrunert/siketest/addingtest'),
                        "icon" => "icon-pencil",
                        "permissions" => ["jonasgrunert.siketest.edit_tests"]
                    ],
    				"question" => [
    					"label" => "Questions",
    					"url" => Backend::url('jonasgrunert/siketest/question'),
    					"icon" => "icon-question-circle",
    					"permissions" => ["jonasgrunert.siketest.edit_tests"]
    				],
    				"answers" =>[
    					"label" => "Answers",
    					"url" => Backend::url('jonasgrunert/siketest/answer'),
    					"icon" => "icon-exclamation-circle",
    					"permissions" => ["jonasgrunert.siketest.edit_tests"]

    				]
    			]
    		]
    	];
    }

    public function registerPermissions(){
    	return [
    		"jonasgrunert.siketest.access_tests" => [
    			"label" => "Accessing all tests",
    			"tab" => "Test"
    		],
    		"jonasgrunert.siketest.edit_tests" => [
    			"label" => "Edit all tests",
    			"tab" => "Test"
    		]
    	];
    }

    public function registerComponents()
    {
    	return [
    		'JonasGrunert\Siketest\components\Testpage' => 'TestPage',
            'JonasGrunert\Siketest\components\Testlist' => 'TestList'
    	];
    }

    public function registerFormWidgets(){
        return [
            'JonasGrunert\Siketest\formwidgets\TextRelation' => 'textrelation',
            'JonasGrunert\Siketest\formwidgets\CheckRelation' => 'checkrelation',
            'JonasGrunert\Siketest\formwidgets\NestedRepeater' => 'nestedrepeater'
        ];
    }

    public function registerSettings()
    {
    }
}
