@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="allPosts d-flex justify-content-between align-items-center">
                            {{ __('Hai eseguito l\'accesso!') }}
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-info">Continua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
