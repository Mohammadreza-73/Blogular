@extends('Admin::layouts.master')

@section('title', 'User Profile')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @session('success')
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endsession
                </div>

                <div class="col-12 col-md-6">
                    <form action="{{ route('admin.profile.update', ['user' => $user->id]) }}" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="user_name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="user_name" class="form-control" id="user_name" placeholder="User Name" value="{{ old('user_name') ?? $user->name }}">
                            </div>

                            @if($errors->has('user_name'))
                            <div class="text-danger small">{{ $errors->first('user_name') }}</div>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="user_email" class="form-control" id="user_email" placeholder="Email" value="{{ old('user_email') ?? $user->email }}">
                            </div>

                            @if($errors->has('user_email'))
                            <div class="text-danger small">{{ $errors->first('user_email') }}</div>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="user_password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Password">
                            </div>

                            @if($errors->has('user_password'))
                            <div class="text-danger small">{{ $errors->first('user_password') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-info">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection