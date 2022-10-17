<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnfixedPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unfixed_permits', function (Blueprint $table) {
            $table->id();
            $table->text('workers_names');
            $table->text('ar_workers_names');
            $table->text('workers_ids');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('company_id');
            $table->enum('active', [0, 1])->default(0);
            $table->foreignId('requested_by')->nullable()->constrained('users', 'id')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('group_id')->constrained()->onUpdate('cascade')->onDelete('no action');
            $table->enum('is_approved', [0, 1])->nullable();
            $table->string('state_change_by', 25)->nullable();
            $table->string('state_change_time', 25)->nullable();
            $table->enum('is_safety_approved', [0, 1])->nullable();
            $table->string('safety_state_change_by', 25)->nullable();
            $table->string('safety_state_change_time', 25)->nullable();
            $table->enum('is_security_approved', [0, 1])->nullable();
            $table->string('security_state_change_by', 15)->nullable();
            $table->string('security_state_change_time', 15)->nullable();
            $table->string('state', 50)->default('pending');
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
        Schema::dropIfExists('unfixed_permits');
    }
}
