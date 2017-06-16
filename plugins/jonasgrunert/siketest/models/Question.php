<?php namespace JonasGrunert\Siketest\Models;

use Model;

/**
 * Model
 */
class Question extends Model
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
    public $table = 'jonasgrunert_siketest_questions';

    // Relations
    public $hasMany = [
        'Answers' => 'JonasGrunert\Siketest\Models\Answer'
    ];
}