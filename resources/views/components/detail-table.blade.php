<div class="w-full py-24 px-60 flex justify-center items-center bg-white max-md:px-5">
    <div class="w-full relative overflow-x-auto space-y-7">
        <h1 class="font-extrabold text-4xl max-md:mb-5 max-md:text-2xl">Mitra yang berpartisipasi</h1>

        <!-- Filter -->
        <div class="mb-6">
            <form action="#" method="GET" id="filterForm" class="flex space-x-4">
                <select id="tahunFilter" name="tahun" class="rounded-md border-gray-300">
                    <option value="">Pilih Tahun</option>
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
                <select id="kuartalFilter" name="kuartal" class="rounded-md border-gray-300">
                    <option value="">Pilih Kuartal</option>
                    <option value="1">Kuartal 1 (Jan-Mar)</option>
                    <option value="2">Kuartal 2 (Apr-Jun)</option>
                    <option value="3">Kuartal 3 (Jul-Sep)</option>
                    <option value="4">Kuartal 4 (Okt-Des)</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Filter</button>
            </form>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Mitra</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Judul Laporan</th>
                    <th scope="col" class="px-6 py-3">Tanggal Pengajuan</th>
                    <th scope="col" class="px-6 py-3">Kuartal</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody id="mitraTableBody">
                @foreach($mitra as $user)
                <tr class="bg-white hover:bg-gray-50" data-tahun="{{ $user->tahun }}" data-kuartal="{{ $user->kuartal }}">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->laporan->first()->judul_laporan ?? 'Belum ada laporan' }}</td>
                    <td class="px-6 py-4">{{ $user->laporan->first()->created_at->format('d/m/Y') ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $user->kuartal ?? '-' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="/mitra-list/{{ $user->id }}" class="font-medium text-blue-600 hover:underline">Lihat Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const tahunFilter = document.getElementById('tahunFilter');
    const kuartalFilter = document.getElementById('kuartalFilter');
    const tableRows = document.querySelectorAll('#mitraTableBody tr');

    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        filterTable();
    });

    function filterTable() {
        const selectedTahun = tahunFilter.value;
        const selectedKuartal = kuartalFilter.value;

        tableRows.forEach(row => {
            const rowTahun = row.getAttribute('data-tahun');
            const rowKuartal = row.getAttribute('data-kuartal');

            const tahunMatch = selectedTahun === '' || rowTahun === selectedTahun;
            const kuartalMatch = selectedKuartal === '' || rowKuartal === selectedKuartal;

            if (tahunMatch && kuartalMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});
</script>

