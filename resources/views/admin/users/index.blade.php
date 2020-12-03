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
            @foreach ($data['superadmins'] as $user)
              <a href="{{route('admin.users.show', $user->id)}}">{{$user->name}}</a>
              <br>
            @endforeach
            @endrole

            <br>
            @role('superadmin|admin')
            <h3>Admins</h3>
            @foreach ($data['admins'] as $user)
              <a href="{{route('admin.users.show', $user->id)}}">{{$user->name}}</a>
              <br>
            @endforeach
            @endrole
            <br>

            <h3>Users</h3>
            @php
              $users = App\User::role('user')->orderBy('name')->paginate(25);
            @endphp
            @foreach ($users as $user)
              <a href="{{route('admin.users.show', $user->id)}}">{{$user->name}}</a>
              <br>
            @endforeach
            <div class="p-2">
              {{ $users->links() }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
