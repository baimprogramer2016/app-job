@extends('layouts.app')
@section('title-page')
Tambah Task
@endsection
@push('style-bawah')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/assets/css/mystyle.css">
@endpush

@section('content')
<div class="pagetitle">
    <h1>Ubah Task</h1>
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
                <a href="#" class="active">Ubah Task</a>
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
                <h5 class="card-title">Mengubah Task Pada Anggota</h5>
                @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('alertcolor') }}">
                    <i class="bi bi-check-circle me-3"></i>{{ Session::get('message') }}
                </div>
                @endif
                @if($errors->all())
                <ul  class="alert alert-danger ms-3">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                <!-- General Form Elements -->
                <form action="{{ route('proses-project-update-task',$datatugasid->id) }}" method="POST">
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
                              <option value="{{ $datatugasid->kodepengguna }}">{{ $datatugasid->user->nama }}</option>
                              @foreach ($dataanggota as $anggota)
                                <option value="{{ $anggota->kode }}">{{ $anggota->nama }}</option>
                              @endforeach
                              </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="kodealias" class="col-sm-2 col-form-label"
                      >Subject</label
                    >
                    <div class="col-sm-10">
                      <input type="text" style="background-color:#fff;"  value="{{ $datatugasid->subject }}" name="subject" id="subject" class="form-control" />
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Deskripsi Task</label>
                    <div class="col-sm-10">
                        <textarea
                        id='deskripsi'
                        name='deskripsi'
                        class="form-control"
                        placeholder="Tulis Deskripsi Pekerjaan"
                        id="floatingTextarea"
                        style="height: 100px"
                      >{{ $datatugasid->deskripsi }}</textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Target Selesai</label>
                    <div class="col-sm-10">
                   
                        <input type="date" id='tanggalakhir' name='tanggalakhir' class="form-control" value="{{ $datatugasid->tanggalakhir }}"/>
                    </div>
                  </div>
                 

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">
                        Update
                      </button>
                    </div>
                  </div>
                </form>
                <!-- End General Form Elements -->
              </div>
            </div>
          </div>

        {{-- <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daftar Task</h5>
             <!-- list task -->
             @include('pages.project-daftar-task')
            </div>
          </div><!-- End Pill Badges -->
        </div> --}}

    </div>
</section>
@endsection  

@push('script-bawah')
<script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'deskripsi' );
    </script>

<script>

    
@endpush

        