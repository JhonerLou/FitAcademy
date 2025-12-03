<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nutrition;
class NutritionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // --- SUPPLEMENTS ---
            [
                'name' => 'Whey Protein Isolate',
                'category' => 'Supplement',
                'description' => 'Protein cepat serap yang ideal dikonsumsi setelah latihan untuk memicu sintesis protein otot (MPS). Mengandung sedikit laktosa dan lemak.',
                'dosage' => '1 scoop (20-25g protein) post-workout',
                'calories_per_serving' => 110,
            ],
            [
                'name' => 'Creatine Monohydrate',
                'category' => 'Supplement',
                'description' => 'Suplemen paling teruji secara ilmiah. Meningkatkan stok fosfokreatin (ATP) di otot untuk tenaga eksplosif dan menambah volume sel otot.',
                'dosage' => '5 gram per hari (kapan saja)',
                'calories_per_serving' => 0,
            ],
            [
                'name' => 'BCAA (Branched-Chain Amino Acids)',
                'category' => 'Supplement',
                'description' => 'Asam amino esensial (Leucine, Isoleucine, Valine) yang membantu mencegah katabolisme (penyusutan otot) saat latihan dalam kondisi defisit kalori.',
                'dosage' => '5-10 gram saat latihan (intra-workout)',
                'calories_per_serving' => 10,
            ],
            [
                'name' => 'Pre-Workout (Caffeine + Citrulline)',
                'category' => 'Supplement',
                'description' => 'Kombinasi stimulan untuk fokus (Caffeine) dan pump (Citrulline). Meningkatkan intensitas latihan dan aliran darah ke otot.',
                'dosage' => '1 serving 20-30 menit sebelum latihan',
                'calories_per_serving' => 5,
            ],


            [
                'name' => 'Dada Ayam (Chicken Breast)',
                'category' => 'Food_Source',
                'description' => 'Sumber protein hewani paling lean (rendah lemak). Mengandung profil asam amino lengkap untuk pertumbuhan otot.',
                'dosage' => '100g (mentah)',
                'calories_per_serving' => 120,
            ],
            [
                'name' => 'Telur Rebus (Whole Egg)',
                'category' => 'Food_Source',
                'description' => 'Protein dengan nilai biologis tertinggi. Kuning telur mengandung lemak sehat dan kolesterol yang dibutuhkan untuk produksi hormon testosteron.',
                'dosage' => '1 butir besar',
                'calories_per_serving' => 70,
            ],
            [
                'name' => 'Nasi Putih',
                'category' => 'Food_Source',
                'description' => 'Sumber karbohidrat cepat serap. Sangat baik dikonsumsi post-workout untuk mengisi kembali glikogen otot dengan cepat.',
                'dosage' => '100g (matang)',
                'calories_per_serving' => 130,
            ],
        ];

        foreach ($items as $item) {
            Nutrition::create($item);
        }
    }
}
