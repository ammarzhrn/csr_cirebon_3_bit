@section('notif')   
    @if(auth()->user()->level === 'mitra')
    @foreach ($laporan_notif as $row)
        <div class="p-4 mb-2 mx-2 rounded-lg border-2 {{ $row->is_read_user === 0 ? 'bg-red-50' : '' }}">
            <div class="w-[30%] flex items-center rounded-lg">
                <div class="flex w-auto justify-center items-center rounded-lg"></div>
                @if($row->status === 'revisi')
                    <p class="font-semibold text-xs text-yellow-600 px-3 py-2 bg-yellow-50 rounded-lg">Revisi!</p>
                @elseif($row->status === 'tolak')
                    <p class="font-semibold text-xs text-red-600 px-3 py-2 bg-red-50 rounded-lg">Tolak!</p>
                @elseif($row->status === 'terbit')
                    <p class="font-semibold text-xs text-green-600 px-3 py-2 bg-green-50 rounded-lg">Diterima!</p>
                @endif
            </div>
            <p class="text-lg font-medium mt-1">{{ $row->judul_laporan }}</p>
            <p class="text-sm text-gray-600 mt-1">{{ $row->pesan_admin }}</p>
            @if($row->is_read_user === 0)
                <form method="POST" action="{{ route('laporan.notif2', $row->id) }}">
                    @csrf
                    <button type="submit" class="mt-2 px-4 py-[5px] bg-red-800 text-sm text-white rounded-md hover:bg-red-700 transition duration-150 ease-in-out">
                        Siap!
                    </button>
                </form>
            @endif
        </div>
    @endforeach
    @endif
@endsection