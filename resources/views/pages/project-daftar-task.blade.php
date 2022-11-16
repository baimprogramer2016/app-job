<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pengguna</th>
            <th scope="col">Subject</th>
            <th scope="col">Deskripsi Task</th>
            <th scope="col">Mulai</th>
            <th scope="col">Akhir</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
            <th scope="col">Tanggal</th>
            
        </tr>
    </thead>
    <tbody>
        
        @foreach ($datatugas as $key => $item_tugas)
            
        
        <tr id="row_{{ $item_tugas->id  }}">
            <th scope="row">{{ $key+ $datatugas->firstItem() }}</th>
            <td>{{ $item_tugas->user->nama }}</td>
            <td>{{ $item_tugas->subject }}</td>
            <td>{!! $item_tugas->deskripsi !!}</td>
            <td>{{ $item_tugas->tanggal }}</td>
            <td>{{ $item_tugas->tanggalakhir }}<br><i class='text-danger' style="font-size:13px;">{{ $item_tugas->info }}</i></td>
            <td>{{ ($item_tugas->status == 'W')?'Waiting':'Done' }}</td>
            <td>
                <div
                    class="btn-group"
                    role="group"
                    aria-label="Basic example"
                >
                    <a
                       href="{{ route('project-edit-task', [$dataproject->slug,$item_tugas->id]) }}"
                        class="btn btn-sm btn-info text-white"
                    >
                        Ubah
            </a>

                    <button
                        onClick="deleteRow('{{ $item_tugas->id }}','{{ $dataproject->slug }}')"
                        type="button"
                        class="btn btn-sm btn-danger"
                    >
                        Hapus
                    </button>
                </div>
            </td>
            <td><i>{{ $item_tugas->updated_at->diffForHumans() }}</i></td>
        </tr>
        @endforeach
    
    </tbody>
  </table>
  {{ $datatugas->links() }}