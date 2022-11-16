@extends('layouts.app')
@section('title-page')
Users
@endsection
@push('style-bawah')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="pagetitle">
    <h1>Pengaturan Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Pengaturan</a>
            </li>
            <li class="breadcrumb-item active">Pengguna</li>
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
                            Input / Update Data Pengguna
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
                    Tambah Data
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
                            <h5 class="card-title">Daftar Data Pengguna</h5>
                            <!-- Table with stripped rows -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama Pengguna</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                        <th scope="col">
                                            Tanggal Modifikasi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datapengguna as $key => $item_pengguna)
                                        
                                    
                                    <tr id="row_{{ $item_pengguna->id  }}">
                                        <th scope="row">{{ $key+ $datapengguna->firstItem() }}</th>
                                        <td>{{ $item_pengguna->kode }}</td>
                                        <td>{{ $item_pengguna->nama }}</td>
                                        <td>{{ $item_pengguna->email }}</td>
                                        <td>{{ $item_pengguna->kodeunit }}</td>
                                        <td>{{ $item_pengguna->koderole }}</td>
                                        <td>{{ $item_pengguna->level->nama }}</td>
                                        <td>{{ ($item_pengguna->allowed == 1)?'Aktif':'Tidak Aktif' }}</td>
                                        <td>
                                            <div
                                                class="btn-group"
                                                role="group"
                                                aria-label="Basic example"
                                            >
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-info text-white"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#basicModal"
                                                    onClick="getFormEdit('{{ $item_pengguna->id }}')"
                                                >
                                                    Ubah
                                                </button>

                                                <button
                                                    onClick="deleteRow({{ $item_pengguna->id }})"
                                                    type="button"
                                                    class="btn btn-sm btn-danger"
                                                >
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                        <td><i>{{ $item_pengguna->updated_at->diffForHumans() }}</i></td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                            {{ $datapengguna->links() }}
                            <!-- End Table with stripped rows -->
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script-bawah')
<script>
//delete 
    function deleteRow(paramId)
    {
        var result = confirm("Want to delete?");
        if (result) {
        $.ajax({
                type:"post",
                data:{
                    id: paramId,
                    _token: "{{ csrf_token() }}"
                },
                url:"{{ route('pengguna-delete') }}",
                success:function(response){
                    $("#row_"+response).remove();
                }
            })
        }
    }

//add form    
    function getFormAdd()
    {
        $.ajax({
            type:"GET",
            url:"{{ route('pengguna-add') }}",
            success: function(response)
            {
                $("#content-model").html("");
                $("#content-model").html(response);
            }
        })
    }
//edit form    
function getFormEdit($id)
{
    var url     = '{{ route("pengguna-edit", ":id") }}';
    urlEdit     = url.replace(':id',$id);

    {
        $.ajax({
            type:"GET",
            url:urlEdit,
            success: function(response)
            {
                $("#content-model").html("");
                $("#content-model").html(response);
            }
        })
    }  
}  
   
</script>
@endpush