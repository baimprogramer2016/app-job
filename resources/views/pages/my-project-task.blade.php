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
            <li class="breadcrumb-item">
                <a href="{{ route('my-project') }}">Daftar Project</a>
            </li>
            <li class="breadcrumb-item active">Daftar Task</li>
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
                            <h5 class="card-title">Task Project {{ $project->nama }}</h5>
                            <!-- Table with stripped rows -->
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Target Selesai</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($daftartask as $key => $task)
                                <tr>
                                    <th scope="row">{{ $key+ $daftartask->firstItem() }}</th>
                                    <td>{{ $task->subject }}</td>
                                    <td>{!! $task->deskripsi !!}</td>
                                    <td>{{ $task->tanggal }}</td>
                                    <td class="indicator_{{ $task->id }} {{ $task->indicator }}">{{ $task->tanggalakhir }} <br><i class="info_{{ $task->id }}" style="font-size:12px;">{{ $task->info }}</i> </td>
                                    <td class="row_{{ $task->id }} {{ $task->indicator }}">{{ ($task->status == 'W')?'Waiting' : 'Done' }}</td>
                                    <td>
                                        <div class="form-check form-switch ms-3">
                                            <input
                                                {{ ($task->status =='D') ? 'checked' : '' }}
                                              class="form-check-input statusChecked_{{ $task->id }}"
                                              type="checkbox"
                                              id="flexSwitchCheckDefault"
                                              onClick="updateStatusTask('{{ $task->id }}')"
                                            />
                                          </div>
                                    </td>
                                </tr>
                                @endforeach
                                 
                                </tbody>
                              </table>
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

    function updateStatusTask(paramId)
    {
        var status = $('.statusChecked_'+paramId).is(':checked');
        
        if(status == true)
        {
            valueStatus = 'D';
        }
        else{
            valueStatus = 'W';
        }
        $.ajax({
            url:"{{ route('proses-my-project-update-task') }}",
            type:'POST',
            data:{
                id:paramId, 
                status:valueStatus,
                 _token: "{{ csrf_token() }}" 
                },
            success:function(response)
            {
                // console.log(response)
                    $(".row_"+paramId).text(response.text)
                    $(".row_"+paramId).attr("style","color:"+response.indicator+" !important")
                    $(".indicator_"+paramId).attr("style","color:"+response.indicator+" !important")
                    $(".info_"+paramId).text(response.info)
                    alert("Berhasil Update Status Task")
            
            }
        });

    }
</script>
