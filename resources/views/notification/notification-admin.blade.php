@section('notif')
    @if(auth()->user()->level === 'admin')
    @foreach ($all_notifications as $row)
        <div class="p-4 mb-2 mx-2 rounded-lg border-2 {{ $row->is_read === 0 ? 'bg-red-50' : '' }}">
            <div class="w-[30%] flex items-center rounded-lg">
                <div class="flex w-auto justify-center items-center rounded-lg"></div>
                <p class="font-semibold text-xs text-blue-500 px-3 py-2 bg-blue-50 rounded-lg">
                    @if($row instanceof \App\Models\Summary)
                        Mitra Baru!
                    @elseif($row instanceof \App\Models\Laporan)
                        Laporan Baru!
                    @elseif($row instanceof \App\Models\Pengajuan)
                        Pengajuan Baru!
                    @endif
                </p>
            </div>
            <p class="text-lg font-semibold mt-1">
                @if($row instanceof \App\Models\Summary)
                    {{ $row->nama_mitra }}
                @elseif($row instanceof \App\Models\Laporan)
                    {{ $row->judul_laporan }}
                @elseif($row instanceof \App\Models\Pengajuan)
                    {{ $row->nama_program }}
                @endif
            </p>
            <p class="text-sm text-gray-600 mt-1">
                @if($row instanceof \App\Models\Summary)
                    {{ $row->nama }}
                @elseif($row instanceof \App\Models\Laporan)
                    {{ $row->user->name }}
                @elseif($row instanceof \App\Models\Pengajuan)
                    {{ $row->nama }}
                @endif
            </p>
            @if($row->is_read === 0)
                <form method="POST" action="
                    @if($row instanceof \App\Models\Summary)
                        {{ route('summary.notif', $row->id) }}
                    @elseif($row instanceof \App\Models\Laporan)
                        {{ route('laporan.notif', $row->id) }}
                    @elseif($row instanceof \App\Models\Pengajuan)
                        {{ route('pengajuan.notif', $row->id) }}
                    @endif
                ">
                    @csrf
                    @method('POST')
                    <button type="submit" class="mt-2 px-4 py-[5px] bg-red-800 text-sm text-white rounded-md hover:bg-red-700 transition duration-150 ease-in-out">
                        Siap!
                    </button>
                </form>
            @endif
        </div>
    @endforeach
    @endif
@endsection