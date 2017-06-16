<?php namespace JonasGrunert\Aboutus\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class AboutUs_View extends Controller
{
    public $implement = ['Backend\Behaviors\ListController'];
    
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'aboutus_view' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('JonasGrunert.Aboutus', 'main-menu-item');
    }
}