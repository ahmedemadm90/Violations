<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnfixedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unfixed_services', function (Blueprint $table) {
            $table->id();
            $table->string('en_name');
            $table->string('ar_name');
            $table->string('en_job')->nullable();
            $table->string('ar_job');
            $table->string('address');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('nid');
            $table->string('gender')->nullable();
            $table->foreignId('company_id')->nullable()->constrained('service_companies')
                ->onUpdate('cascade')->ondelete('restrict')->default(null);
            $table->foreignId('permit_id')->nullable();
            $table->enum('blacklist', [0, 1])->default(0);
            $table->enum('active', [0, 1])->default(1);
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
        Schema::dropIfExists('unfixed_services');
    }
}
