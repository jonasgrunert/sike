<?php namespace JonasGrunert\Aboutus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertAboutusMembers extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_aboutus_members', function($table)
        {
            $table->date('birthday')->nullable();
            $table->string('surname', 50)->change();
            $table->string('name', 50)->change();
            $table->string('nickname', 50)->change();
            $table->string('role', 100)->change();
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_aboutus_members', function($table)
        {
            $table->dropColumn('birthday');
            $table->string('surname')->change();
            $table->string('name')->change();
            $table->string('nickname')->change();
            $table->string('role')->change();
        });
    }
}
