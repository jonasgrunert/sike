<?php namespace JonasGrunert\Aboutus;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents(){
    	return [
    		"JonasGrunert\Aboutus\Components\Members" => "Members"
    	];
    }

    public function registerSettings()
    {
    }
}
