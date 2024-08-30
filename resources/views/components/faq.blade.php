{{-- FAQ --}}
<div class="w-screen py-24 px-60 flex max-md:flex-col justify-center items-center space-y-9 max-md:px-5 bg-slate-900">
    <div class="w-1/2 h-full flex justify-start items-start flex-col space-y-2 max-md:w-full">
        <h1 class="font-extrabold text-white text-4xl">Frequently Asked Question (FAQ)</h1>
        <h1 class="font-normal text-white text-xl">Frequently Asked Questions</h1>
        <div class="w-full h-full flex justify-center items-start flex-col">
            @foreach ($faq as $item)
                <button onclick="showFAQ({{ $item->id }})" 
                    class="faq-button max-md:w-full w-4/5 px-10 py-7 text-white bg-white text-left bg-opacity-10 mt-4 flex justify-start items-center rounded-md text-xl font-bold hover:bg-opacity-30 transition"
                    data-faq-id="{{ $item->id }}">
                    {{ $item->pertanyaan }}
                </button>
            @endforeach
        </div>
    </div>
    <div id="faq-detail" class="w-1/2 h-96 flex flex-col bg-gray-800 p-5 rounded-md text-white max-md:w-full">
        <!-- Detail FAQ akan muncul di sini -->
        <p>Pilih salah satu pertanyaan untuk melihat jawabannya.</p>
    </div>
</div>

<style>
    .faq-button.active {
        background-color: rgba(255, 255, 255, 0.3);
        border: 2px solid white;
    }

    #faq-detail {
        max-height: 80%; /* Atur sesuai kebutuhan */
        overflow: hidden; /* Cegah overflow jika ada konten yang sangat panjang */
        display: flex;
        flex-direction: column;
        padding: 16px;
        box-sizing: border-box;
    }

    #faq-detail > div {
        flex-grow: 1; /* Allow content to grow and fill available space */
        overflow: hidden; /* Cegah konten meluber dari div */
        text-overflow: ellipsis; /* Tambahkan ellipsis jika teks terlalu panjang */
        word-wrap: break-word; /* Membungkus kata jika terlalu panjang */
        word-break: break-word; /* Memecah kata jika terlalu panjang */
    }

    .sector-button.active {
        background-color: rgba(255, 255, 255, 0.3);
        border: 2px solid white;
    }
</style>

<script>
    // Panggil showDetail secara default setelah halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Ganti ID sektor sosial dengan ID yang sesuai
        const defaultSektorId = 1; // ID sektor sosial
        showDetail(defaultSektorId);
    });

    const faqDetails = @json($faq);

    function showFAQ(faqId) {
        const selectedFAQ = faqDetails.find(faq => faq.id === faqId);
        
        const detailContainer = document.getElementById('faq-detail');
        if (selectedFAQ) {
            detailContainer.innerHTML = `
                <div>
                    <p>${selectedFAQ.jawaban}</p>
                </div>
            `;
        } else {
            detailContainer.innerHTML = `<p>Jawaban tidak ditemukan.</p>`;
        }

        const buttons = document.querySelectorAll('.faq-button');
        buttons.forEach(button => {
            button.classList.remove('active');
            if (parseInt(button.getAttribute('data-faq-id')) === faqId) {
                button.classList.add('active');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const defaultFAQId = 1; // ID FAQ default
        showFAQ(defaultFAQId);
    });
</script>