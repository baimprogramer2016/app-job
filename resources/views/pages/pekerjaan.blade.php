@extends('layouts.app')
@section('title-page')
Pekerjaan Harian
@endsection
@push('style-bawah')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="pagetitle">
    <h1>Daftar Pekerjaan Harian</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">pekerjaan</a>
            </li>
            <li class="breadcrumb-item active">Daftar</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="modal fade" id="basicModal" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">
                            Buat pekerjaan
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
        <div class="col-lg-12 col-md-12 ">
            <div class="col-md-12 d-flex flex-row-reverse justify-content-between ">
               
                    <button
                        type="button"
                        class="btn btn-sm btn-primary mb-2"
                        
                        data-bs-toggle="modal"
                        data-bs-target="#basicModal"
                        onClick="getFormAdd()"
                    >
                       Buat pekerjaan
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
            
            <div class="card mt-1">
               
                <div class="card-body" id="content-table">
                    <div class="container">
                        {{-- <h1 class="text-success"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Loading </h1> --}}
                         
                        <div class='col-md-12'>
                            <h5 class="card-title">Daftar pekerjaan</h5>
                        </div>
                        <div class="row w-100 ">
                                    <div for="inputDate" class="col-md-2 col-sm-12  col-form-label" 
                                      > Pencarian : </div
                                    >
                                    <div class="col-md-4 col-sm-12">
                                      <input type="text" class="form-control" />
                                    </div>
                                    <div class="col-md col-sm-12" >
                                      <input type="submit" class="btn btn-success" value="Cari" />
                                    </div>
                                
                            
                        </div>
                            <!-- Table with stripped rows -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datapekerjaan as $key => $item_pekerjaan)
                                
                                    <tr id="row" class="row_{{ $item_pekerjaan->id }}">
                                        <th scope="row">{{ $key+$datapekerjaan->firstItem() }}</th>
                                        <td>{{ $item_pekerjaan->subject }}</td>
                                        <td>{!! $item_pekerjaan->deskripsi !!}</td>
                                        <td>{{ $item_pekerjaan->created_at }}</td>
                                      
                                        <td>
                                            <div
                                                class="btn-group"
                                                role="group"
                                                aria-label="Basic example"
                                            >
                                              
                                                <a  
                                                    onClick="deletepekerjaan('{{ $item_pekerjaan->id }}')"
                                                    type="button"
                                                    class="btn btn-sm btn-danger text-white"
                                                >
                                                <i class="bi bi-folder2-open"></i> Hapus pekerjaan
                                                </a>
                                              

                                            </div>
                                        </td>                                      
                                    </tr>
        
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $datapekerjaan->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script-bawah')

<script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'deskripsi' );
</script>

<script>

    function deletepekerjaan(paramId)
    {
        $.ajax({
            url:"{{ route('proses-pekerjaan-delete') }}",
            type:'POST',
            data:{
                id:paramId,   
                _token: "{{ csrf_token() }}"
            },
            success: function(response)
            {
                $(".row_"+paramId).remove()
            }
        })
    }
    function getFormAdd()
    {
        $.ajax({
            type:"GET",
            url:"{{ route('pekerjaan-add') }}",
            success: function(response)
            {
                $("#content-model").html("");
                $("#content-model").html(response);
            }
        })
    }
</script>


@endpush



