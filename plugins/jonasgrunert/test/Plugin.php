<?php namespace JonasGrunert\Test;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents(){
    	return[
    		'JonasGrunert\Test\Components\testPage' => 'testPage'
    	];
    }

    public function registerSettings()
    {
    }
}
