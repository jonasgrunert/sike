<?php namespace JonasGrunert\Siketest\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Answer extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'jonasgrunert.siketest.edit_tests' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('JonasGrunert.Siketest', 'test', 'answer');
    }
}