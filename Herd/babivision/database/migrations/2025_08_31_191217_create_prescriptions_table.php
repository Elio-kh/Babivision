<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('prescriptions', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->string('eye')->enum('left','right','both');
$table->decimal('sphere', 4, 2)->nullable();
$table->decimal('cylinder', 4, 2)->nullable();
$table->integer('axis')->nullable();
$table->decimal('add', 4, 2)->nullable();
$table->date('issued_at');
$table->timestamps();
});
}
public function down(): void { Schema::dropIfExists('prescriptions'); }
};