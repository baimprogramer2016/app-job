@extends('layouts.app')
@section('title-page')
Detail Project
@endsection
@push('style-bawah')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="pagetitle">
    <h1>Detail Project</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a>Project</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('project') }}">Daftar</a>
            </li>
            <li class="breadcrumb-item active">{{ $dataproject->nama }}</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
      
            <!-- anggota -->
            <div class="col-xxl-3 col-md-6" style="cursor:pointer" onClick="tambahMember('{{ $dataproject->slug }}')">
                <div class="card info-card sales-card bg-info">
  
                  <div class="card-body ">
                    <h5 class="card-title text-white">Tambah Member <span class="text-white"></span></h5>
  
                    <div class="d-flex align-items-center ">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people-fill"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $dataanggota->count() }} Member</h6>
                        {{-- <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1 text-white">Member</span> --}}
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End anggota -->
            <!-- Tugas -->
            <div class="col-xxl-3 col-md-6" style="cursor:pointer" onClick="tambahTask('{{ $dataproject->slug }}')">
                <div class="card info-card revenue-card" style="background-color: #76d7c4 ;">
  
                  <div class="card-body ">
                    <h5 class="card-title text-white">Buat Task <span class="text-white"></span></h5>
  
                    <div class="d-flex align-items-center ">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-pencil-square"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $datatask->count() }} Task</h6>
                        {{-- <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1 text-white">Task</span> --}}
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Tugas -->
            <!-- Document -->
            <div class="col-xxl-3 col-md-6" style="cursor:pointer">
                <div class="card info-card customers-card" style="background-color:  #fad7a0  ;">
  
                  <div class="card-body ">
                    <h5 class="card-title text-white">Buat Dokumen <span class="text-white"></span></h5>
  
                    <div class="d-flex align-items-center ">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-folder"></i>
                      </div>
                      <div class="ps-3">
                        <h6>5 Dokumen</h6>
                        {{-- <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1 text-white">Task</span> --}}
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Tugas -->
    </div>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Proses Task </h5>

          <!-- Table with hoverable rows -->
          
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Prosess</th>
                <th scope="col">Jumlah Task</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($dataanggota as $key => $item_anggota)
              
              <tr>
                <th scope="row">{{ $key+ $dataanggota->firstItem() }}</th>
                <td>{{ $item_anggota->user->nama }}</td>
                <td>
                  <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $item_anggota->taskpersen }}%" aria-valuenow="{{ $item_anggota->taskpersen }}" aria-valuemin="0" aria-valuemax="100">
                      {{ round($item_anggota->taskpersen) }} %
                    </div>
                  </div>
                </td>
                <td>{{ $item_anggota->taskselesai }} / {{ $item_anggota->jumlahtask }} Task</td>
                <td class='detail-task' onClick="detailTask('{{ $dataproject->slug }}','{{ $item_anggota->kodeproject }}','{{ $item_anggota->kodepengguna }}')"><i class="bi bi-folder-fill text-primary"></i> Detail</td>
              </tr>
                      
              @endforeach
            </tbody>
          </table>
          {{ $dataanggota->links() }}
          <!-- End Table with hoverable rows -->

        </div>
      </div>

    </div>
</section>
@endsection  

@push('script-bawah')
    <script>
      function tambahMember(slug)
      {
        var pathlink     = '{{ route("project-tambah-member", ":slug") }}';
        var urlGo     = pathlink.replace(':slug',slug);
        location.href = urlGo
      }
      function tambahTask(slug)
      {
        var pathlink     = '{{ route("project-tambah-task", ":slug") }}';
        var urlGo     = pathlink.replace(':slug',slug);
        location.href = urlGo
      }

      function detailTask(slug, kodeproject, kodepengguna)
      {
        console.log(kodepengguna);
        var pathlink  = '{{ route("project-detail-task",[":slug",":kodeproject", ":kodepengguna"]) }}' ;
        var urlGo = pathlink.replace(":slug", slug).replace(":kodepengguna", kodepengguna).replace(":kodeproject", kodeproject);
        
        location.href = urlGo
      }
    </script>
@endpush

        