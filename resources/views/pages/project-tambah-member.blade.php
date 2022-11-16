@extends('layouts.app')
@section('title-page')
Tambah Member
@endsection
@push('style-bawah')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/assets/css/mystyle.css">
@endpush

@section('content')
<div class="pagetitle">
    <h1>Tambah Anggota</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a>Project</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('project') }}">Daftar</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('project-detail', $dataproject->slug) }}">{{ $dataproject->nama }}</a></li>
            <li class="breadcrumb-item">
                <a href="#" class="active">Tambah Member</a>
            </li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Menambahkan Anggota untuk Projek ini</h5>
                @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('alertcolor') }}">
                    <i class="bi bi-check-circle me-3"></i>{{ Session::get('message') }}
                </div>
                @endif
                <!-- General Form Elements -->
                <form action="{{ route('proses-project-store-member') }}" method="POST">
                    @csrf
                  <div class="row mb-3">
                    <label for="kodeproject" class="col-sm-2 col-form-label"
                      >Kode Project</label
                    >
                    <div class="col-sm-10">
                      <input type="hidden" style="background-color:#cedadc;" readonly value="{{ $dataproject->slug }}" name="slug" id="slug" class="form-control" />
                      <input type="text" style="background-color:#cedadc;" readonly value="{{ $dataproject->kode }}" name="kodeproject" id="kodeproject" class="form-control" />
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="kodealias" class="col-sm-2 col-form-label"
                      >Alias</label
                    >
                    <div class="col-sm-10">
                      <input type="text" style="background-color:#cedadc;" readonly value="{{ $dataproject->alias }}" name="kodealias" id="kodealias" class="form-control" />
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Anggota</label>
                    <div class="col-sm-10">
                   
                              <select
                                name="kodepengguna"
                                id="kodepengguna"
                                class="form-select"
                                aria-label="Default select example"
                              >
                              @foreach ($dataanggota as $anggota)
                                <option value="{{ $anggota->kode }}">{{ $anggota->nama }}</option>
                              @endforeach
                              </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Aksi</label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">
                        Simpan
                      </button>
                    </div>
                  </div>
                </form>
                <!-- End General Form Elements -->
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12">
          <div class="card">
              <div class="card-body">
                <h5 class="card-title">Anggota Projek</h5>
                @foreach ($dataanggotaproject as $key => $anggota_project)
                <div class="badge me-3 badge-me rounded-pill bg-{{ colorTag($key + 1) }}">{{ $anggota_project->user->nama }}
                  <span class="bg-danger remove-badge" onclick="hapusAnggota('{{ $dataproject->kode }}','{{ $anggota_project->kodepengguna }}')">x</span>
                  </div>
                @endforeach
              </div>
            </div><!-- End Pill Badges -->
          </div>

    </div>
</section>
@endsection  

@push('script-bawah')

    <script>
        function hapusAnggota(paramkodeproject, paramkodeanggota)
        {
            $.ajax({
                type:"post",
                data:{
                    kodeproject : paramkodeproject,
                    kodepengguna : paramkodeanggota,
                    "_token": "{{ csrf_token() }}"
                },
                url: "{{ route('proses-project-hapus-member') }}",
                success:function(response){
                  if(response == 'failed')
                  {
                    alert('Gagal , Anggota memiliki Task Project ini');
                  }else{
                    window.location.href = window.location.href
                  }
                    
                }
            })
        }
    </script>
    
@endpush

        