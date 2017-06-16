<?php namespace JonasGrunert\Siketest\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class AddingTest extends Controller
{
    public $implement = ['Backend\Behaviors\FormController'];
    
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'create_test' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('JonasGrunert.Siketest', 'test-main', 'test-new');
    }
}