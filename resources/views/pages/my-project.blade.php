@extends('layouts.app')
@section('title-page')
Project
@endsection
@push('style-bawah')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="pagetitle">
    <h1>Daftar Project</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Project Ku</a>
            </li>
            <li class="breadcrumb-item active">Daftar</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
       
        <!-- End Basic Modal-->
        <div class="col-lg-12 col-md-12">
           
            <div class="card">
               
                <div class="card-body" id="content-table">
                    <div class="container">
                        {{-- <h1 class="text-success"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Loading </h1> --}}
                            <h5 class="card-title">Daftar Project</h5>
                            <!-- Table with stripped rows -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Project</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Prosess</th>
                                        <th scope="col">Aksi</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($dataproject as $key => $item_project)
                                
                                    <tr id="row">
                                        <th scope="row">{{ $key+$dataproject->firstItem() }}</th>
                                        <td>{{ $item_project->project->nama }}<br><span class="text-secondary">{{ $item_project->project->alias }}</span></td>
                                        <td>{{ $item_project->project->deskripsi }}</td>
                                        <td>{{ $item_project->jumlahtaskdone.'/'.$item_project->jumlahtask }}</td>
                                        <td width="400">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $item_project->jumlahtaskpersen }}%" aria-valuenow="{{ $item_project->jumlahtaskpersen }}" aria-valuemin="0" aria-valuemax="100">{{ round($item_project->jumlahtaskpersen) }}%</div>
                                            </div>
                                        </td>
                                      
                                        <td>
                                            <div
                                                class="btn-group"
                                                role="group"
                                                aria-label="Basic example"
                                            >
                                                <a
                                                href="{{ route('my-project-task', $item_project->project->slug) }}"
                                                    type="button"
                                                    class="btn btn-sm btn-success text-white"
                                                >
                                                <i class="bi bi-folder2-open"></i> Buka Task
                                        </a>
                                            </div>
                                        </td>                                      
                                    </tr>
        
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $dataproject->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    function getFormAdd()
    {
        $.ajax({
            type:"GET",
            url:"{{ route('project-add') }}",
            success: function(response)
            {
                $("#content-model").html("");
                $("#content-model").html(response);
            }
        })
    }
</script>
