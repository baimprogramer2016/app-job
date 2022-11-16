@extends('layouts.app')
@section('title-page')
Project
@endsection
@push('style-bawah')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="pagetitle">
    <h1>Pengaturan Project</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Project</a>
            </li>
            <li class="breadcrumb-item active">Daftar</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="modal fade" id="basicModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">
                            Buat Project
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          
                        ></button>
                    </div>
                    <div class="modal-body" id='content-model'>
                        
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- End Basic Modal-->
        <div class="col-lg-12 col-md-12">
            <div class="col-md-12 d-flex flex-row-reverse">
                <button
                    type="button"
                    class="btn btn-sm btn-primary mb-2"
                    
                    data-bs-toggle="modal"
                    data-bs-target="#basicModal"
                    onClick="getFormAdd()"
                >
                   Buat Project
                </button>
            </div>
            @if(Session::has('message'))
            <div class="alert alert-success">
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
                                        <th scope="col">Prosess</th>
                                        <th scope="col">Aksi</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                             
                                    @foreach ($dataproject as $key => $item_project)
                                
                                    <tr id="row" class="row_{{ $item_project->id }}">
                                        <th scope="row">{{ $key+$dataproject->firstItem() }}</th>
                                        <td>{{ $item_project->nama }}<br><span class="text-secondary">{{ $item_project->alias }}</span></td>
                                        <td>{{ $item_project->deskripsi }}</td>
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
                                                href="{{ route('project-detail',$item_project->slug) }}"
                                                    type="button"
                                                    class="btn btn-sm btn-success text-white"
                                                >
                                                <i class="bi bi-folder2-open"></i> Buka Project
                                                </a>
                                                <a  
                                                    onClick="deleteProject('{{ $item_project->id }}')"
                                                    type="button"
                                                    class="btn btn-sm btn-danger text-white"
                                                >
                                                <i class="bi bi-folder2-open"></i> Hapus Project
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

    function deleteProject(paramId)
    {
        $.ajax({
            url:"{{ route('proses-project-delete') }}",
            type:'POST',
            data:{
                id:paramId,   
                _token: "{{ csrf_token() }}"
            },
            success: function(response)
            {
                if(response == 'failed')
                {
                    alert('Gagal , Terdapat Anggota pada Project ini, harap hapus anggota terlebih dahulu')
                }
                else{
                    $(".row_"+paramId).remove()
                }
            }
        })
    }
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
