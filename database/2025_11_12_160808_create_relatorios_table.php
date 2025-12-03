use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tipo')->default('mensal');
            $table->string('titulo')->nullable();
            $table->text('descricao')->nullable();
            $table->decimal('valor_total', 15, 2)->default(0);
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });

        Schema::create('fatura_relatorio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('relatorio_id')->constrained('relatorios')->onDelete('cascade');
            $table->foreignId('fatura_id')->constrained('faturas')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['relatorio_id', 'fatura_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relatorios');
        Schema::dropIfExists('fatura_relatorio');
    }
};
