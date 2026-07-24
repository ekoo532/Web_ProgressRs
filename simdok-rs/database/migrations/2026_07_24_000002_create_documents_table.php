<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category', 100);
            $table->string('file_name');      // nama file fisik tersimpan (disk public/documents)
            $table->string('original_name');  // nama asli file saat diupload

            // Progress otomatis: 25/50/75/100 (lihat Document::computedProgress()).
            // Kolom tetap disimpan agar query lama tetap kompatibel.
            $table->unsignedTinyInteger('progress')->default(25);

            $table->boolean('admin_approved')->default(false);   // tahap 2: direview/di-ACC Admin (50%)
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('reviewed_at')->nullable();

            $table->boolean('director_approved')->default(false); // tahap 3: di-ACC/TTD Direktur (75%)
            $table->boolean('is_completed')->default(false);       // tahap 4: selesai & dikirim ke user (100%)

            $table->foreignId('uploader_id')->constrained('users')->cascadeOnDelete();

            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('approved_at')->nullable();

            $table->foreignId('completed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('completed_at')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
