<?php

namespace Database\Seeders;

use App\Models\ScienceArticle;
use Illuminate\Database\Seeder;

class ScienceArticleSeeder extends Seeder
{
    public function run(): void
    {

        $articles = [
            [
                'title' => '1. Prinsip Utama Hipertrofi Otot',
                'category' => 'Training_Science',
                'summary' => 'Tension, Teknik, dan Progressive Overload sebagai kunci pertumbuhan otot.',
                'content' => '
                    <h3 class="text-xl font-bold mb-2">🔹 Tension (Kunci Utama Pertumbuhan Otot)</h3>
                    <p class="mb-4">Tension adalah faktor utama dalam pertumbuhan otot. Otot hanya bisa tumbuh jika menerima tension mekanis yang cukup tinggi. Tension paling efektif dihasilkan saat fase negatif (eccentric) dilakukan perlahan (2–4 detik).</p>

                    <h3 class="text-xl font-bold mb-2">🔹 Teknik yang Benar</h3>
                    <ul class="list-disc pl-5 mb-4">
                        <li>Gerakan harus terkontrol, stabil, dan konsisten.</li>
                        <li>Hindari momentum atau ayunan tubuh.</li>
                        <li>Range of motion yang dalam (stretch maksimal) lebih penting daripada sekadar mengangkat berat.</li>
                    </ul>

                    <h3 class="text-xl font-bold mb-2">🔹 Effort & RPE (Rating of Perceived Exertion)</h3>
                    <p class="mb-4">Pemula tidak perlu selalu latihan sampai failure. RPE ideal untuk hipertrofi: 7–9. RPE 10 berarti benar-benar gagal mengangkat beban. Menyisakan 1–3 repetisi di cadangan (reps in reserve) sudah cukup untuk memicu pertumbuhan.</p>

                    <h3 class="text-xl font-bold mb-2">🔹 Progressive Overload</h3>
                    <p>Progress dilakukan dengan:</p>
                    <ul class="list-disc pl-5 mb-4">
                        <li>Menambah repetisi</li>
                        <li>Menambah beban</li>
                        <li>Memperbaiki teknik</li>
                        <li>Memperkuat mind-muscle connection</li>
                    </ul>
                ',
            ],
            [
                'title' => '2. Volume & Frekuensi Latihan',
                'category' => 'Training_Science',
                'summary' => 'Panduan set dan frekuensi latihan mingguan.',
                'content' => '
                    <p class="mb-2"><strong>Frekuensi optimal:</strong> setiap otot 2 kali per minggu</p>
                    <p class="mb-4"><strong>Volume efektif:</strong> 10–20 set per otot per minggu</p>

                    <h4 class="font-bold">Program dibagi dua fase:</h4>
                    <ul class="list-disc pl-5 mb-4">
                        <li><strong>Foundation Block:</strong> adaptasi awal</li>
                        <li><strong>Ramping Block:</strong> peningkatan volume & intensitas</li>
                    </ul>
                    <p>Peningkatan dilakukan bertahap untuk menghindari overtraining.</p>
                ',
            ],
            [
                'title' => '3. Latihan Berbasis Mesin & Stabilitas',
                'category' => 'Training_Science',
                'summary' => 'Mengapa mesin dan kabel penting untuk hipertrofi.',
                'content' => '
                    <p class="mb-4">Mesin dan kabel memberikan:</p>
                    <ul class="list-disc pl-5 mb-4">
                        <li>Tension yang lebih stabil</li>
                        <li>Resiko cedera lebih rendah</li>
                        <li>Lebih aman mendekati failure</li>
                    </ul>
                    <p>Program memprioritaskan latihan dengan loaded stretch (otot aktif dalam posisi teregang).</p>
                ',
            ],
            [
                'title' => '4. Anatomi Otot & Fungsinya',
                'category' => 'Anatomy',
                'summary' => 'Ringkasan fungsi otot utama (Dada, Punggung, Kaki, dll).',
                'content' => '
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Dada (Chest):</strong> gerakan dorong (push)</li>
                        <li><strong>Punggung (Lats & Mid Back):</strong> gerakan tarik (pull)</li>
                        <li><strong>Biceps & Triceps:</strong> fleksi & ekstensi siku</li>
                        <li><strong>Bahu (Shoulders):</strong> anterior, lateral, posterior deltoid</li>
                        <li><strong>Kaki (Quadriceps):</strong> ekstensi lutut</li>
                        <li><strong>Kaki (Hamstring):</strong> fleksi lutut & ekstensi pinggul</li>
                        <li><strong>Glutes:</strong> ekstensi pinggul</li>
                        <li><strong>Calves:</strong> plantar flexion</li>
                        <li><strong>Perut (Abs):</strong> fleksor tulang belakang & stabilisator core</li>
                    </ul>
                ',
            ],
            [
                'title' => '5. Ilmu Nutrisi Bodybuilding',
                'category' => 'Nutrition',
                'summary' => 'Kalori, Protein, dan Makronutrisi.',
                'content' => '
                    <h3 class="text-xl font-bold mb-2">🔹 Kalori</h3>
                    <ul class="list-disc pl-5 mb-4">
                        <li>Surplus 5–15% → menaikkan massa otot</li>
                        <li>Defisit 5–15% → menurunkan lemak</li>
                        <li>Maintenance → body recomposition</li>
                    </ul>

                    <h3 class="text-xl font-bold mb-2">🔹 Protein</h3>
                    <p class="mb-4">1.6 – 2.2 gram/kg berat badan per hari. Saat cutting bisa naik hingga 2.7 g/kg.</p>

                    <h3 class="text-xl font-bold mb-2">🔹 Lemak & Karbohidrat</h3>
                    <p>Lemak: 20–30% dari total kalori. Karbohidrat: sisa dari kebutuhan setelah protein & lemak.</p>
                ',
            ],
            [
                'title' => '6. Tracking Progress Secara Ilmiah',
                'category' => 'General_Guide',
                'summary' => 'Cara mengukur kemajuan yang valid.',
                'content' => '
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Strength log</strong> adalah indikator utama pertumbuhan otot</li>
                        <li>Foto progres tiap 1–3 bulan</li>
                        <li>Berat badan naik ideal: 1–2% per bulan</li>
                        <li>Evaluasi berdasarkan rata-rata mingguan, bukan harian</li>
                    </ul>
                ',
            ],
            [
                'title' => '7. Suplemen (Science Based)',
                'category' => 'Nutrition',
                'summary' => 'Creatine, Caffeine, dan Protein Powder.',
                'content' => '
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-bold text-green-400">✅ Creatine Monohydrate</h4>
                            <p>5 gram per hari. Meningkatkan kekuatan dan volume otot.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-green-400">✅ Caffeine</h4>
                            <p>150–250 mg sebelum latihan. Meningkatkan fokus dan performa.</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-green-400">✅ Protein Powder</h4>
                            <p>Membantu memenuhi kebutuhan protein harian.</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-gray-400"><em>Suplemen hanya pendukung, bukan faktor utama hasil.</em></p>

                    <h3 class="text-xl font-bold mt-6">✅ Kesimpulan Ilmiah</h3>
                    <ul class="list-disc pl-5">
                        <li>Otot berkembang melalui tension, teknik, dan progressive overload</li>
                        <li>Nutrisi adalah fondasi utama progres</li>
                        <li>Perkembangan harus diukur dengan data, bukan perasaan</li>
                    </ul>
                ',
            ],
        ];

        foreach ($articles as $article) {
            ScienceArticle::create($article);
        }
    }
}
