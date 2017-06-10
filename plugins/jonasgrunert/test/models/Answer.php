<?php namespace JonasGrunert\Test\Models;

use Model;

/**
 * Model
 */
class Answer extends Model
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
    public $table = 'jonasgrunert_test_answers';

    public $belongsTo = [
        'question' => 'JonasGrunert\Test\Models\Question'
    ];
}