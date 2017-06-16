<?php namespace JonasGrunert\Siketest;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'JonasGrunert\Siketest\components\Testpage' => 'TestPage'
    	];
    }

    public function registerSettings()
    {
    }
}
