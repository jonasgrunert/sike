<?php namespace JonasGrunert\Aboutus;

Use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
	public function pluginDetails(){
		return[
			"name" => "About Us",
			"description" => "Basic About Us plugin.",
			"author" => "Jonas Grunert",
			"icon" => "oc-icon-smile-o"			
		];
	}

	public function registerNavigation(){
		return [
			"aboutus" => [
				"label" => "About Us",
				"url" => Backend::url('jonasgrunert/aboutus/aboutusview'),
				"icon" => "icon-male",
				"permissions" => ["jonasgrunert.aboutus.*"],

				"sideMenu" => [
					"edit" => [
						"label" => "Edit",
						"url" => Backend::url('jonasgrunert/aboutus/aboutus'),
						"icon" => "icon-edit",
						"permissions" => ["jonasgrunert.aboutus.edit_profiles"]
					]
				]
			]
		];
	}

	public function registerPermissions(){
		return [
			"jonasgrunert.aboutus.access_profiles" => [
				"label" => "View all profiles",
				"tab" => "About Us"
			],
			"jonasgrunert.aboutus.edit_profiles" => [
				"label" => "Edit all profiles",
				"tab" => "About Us"
			]
		];
	}

    public function registerComponents(){
    	return [
    		"JonasGrunert\Aboutus\Components\Members" => "Members"
    	];
    }

    public function registerSettings()
    {
    }
}
