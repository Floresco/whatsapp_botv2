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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignUuid('user_profil_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignUuid('user_parent_id')
                ->nullable()
                ->references('id')->on('users')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender', 2)->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_profil_id');
            $table->dropColumn(['user_parent_id', 'firstname', 'lastname', 'gender', 'role']);
        });
        Schema::enableForeignKeyConstraints();
    }
};
