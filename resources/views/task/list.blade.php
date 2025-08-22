@extends('layouts.app')
@section('content')
    <main class="app-main" id="main" tabindex="-1">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Task List</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Task List</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Task List Table</h3>
                        <a class="float-end btn btn-outline-primary m-1" href="{{ route('task.create') }}">+ Add New</a>
                    </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered" role="table">
                      <thead>
                        <tr>
                            <th style="width: 10px">Priority</th>
                            <th>Project</th>
                            <th>Task Name</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th class="text-center">Action</th>
                        </tr>
                      </thead>
                        <tbody id="sortable">
                            @foreach ($tasks as $task)
                                <tr data-id="{{ $task->id }}" class="task_id">
                                    <td>{{ $task->priority }}</td>
                                    <td>{{ $task->project->name }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->created_at }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-outline-primary mx-2">Edit</a>
                                        <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (session('success'))
                    <div class="alert alert-info" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <span id="success" class="text-success"></span>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $("#sortable").sortable({
            stop: function(event, ui){
                const cards = Array.from(document.querySelectorAll('.task_id'));
                const taskId = cards.map(card => card.getAttribute('data-id'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('task.ordering') }}",
                    method: "POST",
                    data: {
                        task_id: taskId
                    },
                    success: function(res){
                        $("#success").html(res)
                    }
                })
            }
        });

    } );
    </script>
@endpush
