<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_access', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_profil_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignUuid('access_right_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->smallInteger('pcreate');
            $table->smallInteger('pread');
            $table->smallInteger('pupdate');
            $table->smallInteger('pdelete');
            $table->smallInteger('etat')->default(\App\Helpers\CodeStatus::ETAT_ACTIVE);
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('profil_access');
        Schema::enableForeignKeyConstraints();
    }
};
