<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'pertanyaan' => 'Apa itu program CSR?',
                'jawaban' => 'Program CSR (Corporate Social Responsibility) adalah inisiatif perusahaan untuk berkontribusi pada pembangunan berkelanjutan dengan memberikan manfaat ekonomi, sosial, dan lingkungan bagi seluruh pemangku kepentingan.'
            ],
            [
                'pertanyaan' => 'Bagaimana cara mengajukan proposal CSR?',
                'jawaban' => 'Untuk mengajukan proposal CSR, Anda perlu menyiapkan dokumen yang berisi latar belakang, tujuan, rencana kegiatan, anggaran, dan dampak yang diharapkan. Kirimkan proposal tersebut ke departemen CSR perusahaan yang dituju.'
            ],
            [
                'pertanyaan' => 'Berapa lama proses persetujuan proposal CSR?',
                'jawaban' => 'Proses persetujuan proposal CSR bervariasi tergantung pada perusahaan, biasanya memakan waktu 1-3 bulan. Selama periode ini, proposal akan dievaluasi dan mungkin ada diskusi lebih lanjut jika diperlukan.'
            ],
            [
                'pertanyaan' => 'Apakah ada batasan dana untuk program CSR?',
                'jawaban' => 'Batasan dana untuk program CSR berbeda-beda tergantung pada kebijakan perusahaan dan skala proyek. Beberapa perusahaan memiliki anggaran tetap, sementara yang lain menyesuaikan dengan kebutuhan proyek.'
            ],
            [
                'pertanyaan' => 'Bagaimana cara melaporkan hasil program CSR?',
                'jawaban' => 'Hasil program CSR dilaporkan melalui laporan tertulis yang mencakup pencapaian, tantangan, dan dampak program. Laporan ini biasanya disertai dengan dokumentasi visual dan data kuantitatif yang relevan.'
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
