@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5 class="mb-4">You are logged in</h5>
                    <div class="mb-2">
                      <a class="btn btn-primary" href="{{route('indexMyData')}}">Mis datos</a>
                    </div>


                    @role('superadmin|admin')
                    <h4>SuperAdmin || Admin </h4>
                    <div class="mb-2">
                      <a class="btn btn-primary" href="{{route('admin.cats')}}">Categories</a>
                    </div>

                    @endrole

                    @role('superadmin')
                    {{-- <h4>SuperAdmin Priviliges</h4> --}}
                    <div class="mb-2">
                      <a class="btn btn-primary" href="{{route('admin.translations')}}">Translations</a>
                    </div>

                    <div class="mb-2">
                      <a class="btn btn-primary" href="{{route('admin.fileManager')}}">Media Manager</a>
                    </div>
                    {{-- <div class="mb-2">
                      <a class="btn btn-primary" href="{{route('admin.roles')}}">Roles</a>
                    </div> --}}
                    <div class="mb-2">
                      <a class="btn btn-primary" href="{{route('admin.databaseExport')}}">Export to Excel</a>
                    </div>

                    <div class="mb-2">
                      <a class="btn btn-primary" href="{{route('admin.showCountryPhones')}}">Whatsapp Config</a>
                    </div>
                    @endrole



                    @can('index users')
                      <div class="mb-2">
                        <a class="btn btn-primary" href="{{route('admin.users')}}">Users</a>
                      </div>
                    @endcan




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
