@extends('layouts.app')
@section('title-page')
Detail Task
@endsection
@push('style-bawah')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="pagetitle">
    <h1>Detail Task</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a>Project</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('project') }}">Daftar</a>
            </li>
         
            <li class="breadcrumb-item">
                <a href="{{ route('project-detail', $slug) }}">{{ Ucwords($slug) }}</a>
            </li>
            <li class="breadcrumb-item active">{{ $kodepengguna }}</li>
        </ol>
    </nav>
    
</div>
<!-- End Page Title -->

<section class="section dashboard">
    @if($datatask->count() !=0)
      @foreach($datatask as $task)
      <div class="row">
          <div class="col-lg">
            <div class="card">
              <div class="card-body">
                <div class='d-flex justify-content-between' >
                  <h5 class="card-title ">{{ $kodeproject }} - {{ $kodepengguna }}</h5>
                  <a class='mt-3' href="{{ route('project-edit-task', [$slug,$task->id]) }}"><i class="bi bi-pencil-square " style='cursor:pointer;'></i></a>
                </div>
                <strong>Subject : {{ $task->subject }}</strong>
                <p>{!!  $task->deskripsi  !!}</p>
                <i>Deadline : {{ $task->tanggalakhir }}</i><br>
                <p class="card-title {{ $task->status == 'W'?'text-warning': '' }}">Status {{ $task->status == 'W'?'Waiting': 'Done' }}</p>
                <i class='text-danger' style="font-size:15px;">{{ $task->info }}</i>
              </div>
            </div>
          </div>
        </div>
      @endforeach  
      @else
      <div
      class="alert alert-primary bg-info text-light border-0 alert-dismissible fade show"
      role="alert"
    >
      Belum ada tugas untuk anggota ini
    
    </div>
      @endif
</section>
@endsection  


        