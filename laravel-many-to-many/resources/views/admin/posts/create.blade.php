@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 ">
                <div class="allPosts d-flex justify-content-between align-items-center">
                    <h1>Nuovo post</h1>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-info"> Torna ai posts</a>
                </div>

                {{-- Titolo card --}}
                <div class="card">
                    <div class="card-header">Scrivi un nuovo post</div>

                    {{-- / Titolo card --}}
                    <div class="card-body">
                        <form action="{{ route('admin.posts.store') }}" method="POST">

                            @csrf

                            {{-- titolo post --}}
                            <div class="form-group">
                                <label for="title">Titolo:</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror "
                                    placeholder="Titolo post" value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / titolo post --}}

                            {{-- Categoria --}}
                            <div class="form-group">
                                <label>Categoria:</label>
                                <select class="border-1" name="category_id"
                                    class="@error('category_id') is-invalid @enderror">
                                    <option value="">-- Scegli Categoria --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / Categoria --}}

                            {{-- contenuto post --}}
                            <div class="form-group">
                                <label for="content">Contenuto:</label>
                                <textarea type="text" name="content" class="form-control @error('content') is-invalid @enderror"
                                    placeholder="Contenuto post">
                                </textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / contenunto post --}}

                            <div class="form-group">
                                <input type="submit" class="btn btn-success white" value="Crea Post">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
