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


            @role('superadmin')
            <a class="btn btn-primary mb-2" href="{{route('admin.users.create')}}">Add employee</a>
            <h3>Super Admins</h3>
                        <b-list-group>
            @foreach ($data['superadmins'] as $user)
                            <b-list-group-item>
              <a href="{{route('admin.users.show', $user->id)}}">{{$user->name}}</a>
                          </b-list-group-item>
            @endforeach
                      </b-list-group>
            @endrole

            <br>
            @role('superadmin|admin')
            <h3>Admins</h3>
            <b-list-group>
            @foreach ($data['admins'] as $user)
              <b-list-group-item>
              <a href="{{route('admin.users.show', $user->id)}}">{{$user->name}}</a>
            </b-list-group-item>
            @endforeach
          </b-list-group>
            @endrole
            <br>

            <h3>Users</h3>
            <a class="btn btn-primary mb-2" href="{{route('admin.users.export')}}">Export Users Table</a>
            <div class="pb-2">
              <form id="searchForm" action="{{route("admin.users")}}" method="get" class="form-inline my-2 my-lg-0">
                {{-- @csrf --}}
                <input class="form-control mr-sm-2" type="search" placeholder="email" aria-label="search" name="query">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__('Search')}}</button>
              </form>
            </div>
            @php
              $users = $data['users'];
              // $users = App\User::role('user')->orderBy('name')->paginate(25);
            @endphp
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($users as $user)
                <tr>
                  <td><a href="{{route('admin.users.show', $user->id)}}">{{$user->name}}</a></td>
                  <td><a href="{{route('admin.users.show', $user->id)}}">{{$user->email}}</a></td>
                </tr>
              @endforeach
              </tbody>
            </table>
            {{-- <b-list-group>
            @foreach ($users as $user)
            <b-list-group-item>
              <a href="{{route('admin.users.show', $user->id)}}">{{$user->name}} &nbsp; &nbsp; &nbsp;||&nbsp; &nbsp; &nbsp; {{$user->email}}</a>
            </b-list-group-item>
            @endforeach
          </b-list-group> --}}
            <div class="p-2">
              {{ $users->links() }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
