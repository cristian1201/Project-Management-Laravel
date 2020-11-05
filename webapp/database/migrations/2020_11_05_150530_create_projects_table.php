<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->double('distance');
            $table->double('gps_x');
            $table->double('gps_y');
            $table->double('percentage1')->default(0);
            $table->double('percentage2')->default(0);
            $table->double('percentage3')->default(0);
            $table->string('attachments')->nullable();
            $table->tinyInteger('status')->default(0); // 0: unstarted, 1: onGoing, 2: finished
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('project_teams', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('team_id');
            $table->string('team_area')->default("Production");
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');
//            $table->primary(['project_id', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_teams');
        Schema::dropIfExists('projects');
    }
}
