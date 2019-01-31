<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminDashboardRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_dashboard_role', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('admin_id')->unsigned();
			$table->foreign('admin_id')->references('id')->on('admins');
			$table->integer('dashboard_role_id')->unsigned();
			$table->foreign('dashboard_role_id')->references('id')->on('dashboard_roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_dashboard_role');
    }
}
