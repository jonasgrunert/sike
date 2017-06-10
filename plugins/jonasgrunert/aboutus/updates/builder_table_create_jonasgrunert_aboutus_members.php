<?php namespace JonasGrunert\Aboutus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJonasgrunertAboutusMembers extends Migration
{
    public function up()
    {
        Schema::create('jonasgrunert_aboutus_members', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('surname', 50);
            $table->string('name', 50);
            $table->string('nickname', 50)->nullable();
            $table->string('role', 100);
            $table->text('fact');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jonasgrunert_aboutus_members');
    }
}
