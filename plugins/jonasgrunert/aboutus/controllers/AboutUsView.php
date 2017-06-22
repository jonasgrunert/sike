<?php namespace JonasGrunert\Aboutus\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class AboutUsView extends Controller
{
    public $implement = ['Backend\Behaviors\ListController'];
    
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
    	"jonasgrunert.aboutus.*"
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('JonasGrunert.Aboutus', 'aboutus');
    }
}