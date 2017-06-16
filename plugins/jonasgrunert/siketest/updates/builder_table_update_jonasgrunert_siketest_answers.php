<?php namespace JonasGrunert\Siketest\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertSiketestAnswers extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_siketest_answers', function($table)
        {
            $table->integer('question_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_siketest_answers', function($table)
        {
            $table->integer('question_id')->nullable(false)->change();
        });
    }
}
