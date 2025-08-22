@extends('layouts.app')
@section('content')
    <main class="app-main" id="main" tabindex="-1">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Project List</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Project List</li>
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
                        <h3 class="card-title">Project List Table</h3>
                        <a class="float-end btn btn-outline-primary m-1" href="{{ route('project.create') }}">+ Add New</a>
                    </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered" role="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Project Name</th>
                                <th>Number of Task</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr data-id="{{ $project->id }}">
                                    <th>{{ $project->id }}</th>
                                    <th>{{ $project->name }}</th>
                                    <th>{{ $project->task->count() }}</th>
                                    <td>{{ $project->description }}</td>
                                    <td>{{ $project->created_at }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('project.edit', $project->id) }}" class="btn btn-outline-primary mx-2">Edit</a>
                                        <form action="{{ route('project.destroy', $project->id) }}" method="POST">
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
