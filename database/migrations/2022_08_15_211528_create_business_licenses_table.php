<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('license_number');
            $table->text('license_img');
            $table->enum('license_type',[1,2,3,4,5])->index()
            ->default(1)
            ->comment('1 => Roofing , 2 => HVAC, 3=> Electrical , 4 => Solar , 5 => General');
            $table->text('state');
            $table->date('license_expiration_date');
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
        Schema::dropIfExists('business_licenses');
    }
}
