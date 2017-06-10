<?php namespace JonasGrunert\Test\Models;

use Model;

/**
 * Model
 */
class Test extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'jonasgrunert_test_tests';

    public $hasMany = [
        'questions' => 'JonasGrunert\Test\Models\Question'
    ];
}