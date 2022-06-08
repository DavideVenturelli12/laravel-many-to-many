@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 ">
                <div class="allPosts d-flex justify-content-between align-items-center">
                    <h1>Modifica post</h1>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-info"> Torna ai posts</a>
                </div>

                {{-- titolo card --}}
                <div class="card">
                    <div class="card-header">Modifica post</div>

                    <div class="card-body">
                        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            {{-- titolo post --}}
                            @method('PUT')
                            <div class="form-group">
                                <h5 for="title">Titolo:</h5>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror "
                                    placeholder="Titolo post" value="{{ old($post->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / titolo post --}}

                            {{-- Cover post --}}
                            <div class="form-group">
                                <div>
                                    <img src="{{ asset('storage/' . $post->cover) }}">

                                </div>
                                <label for="image">Immagine cover:</label>
                                <input type="file" name="image" />

                            </div>
                            {{-- / Cover post --}}

                            {{-- Categoria --}}
                            <div class="form-group">
                                <h5>Categoria:</h5>
                                <select class="border-1" name="category_id">
                                    <option value="">-- Scegli Categoria --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == old('$category_id') ? 'selected' : '' }}>
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
                                <h5 for="content">Contenuto:</h5>
                                <textarea type="text" name="content" class="form-control @error('content') is-invalid @enderror"
                                    placeholder="Contenuto post">
                                    {{ old($post->content) }}
                                </textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / contenuto post --}}

                            {{-- Tags --}}
                            <div class="form-group">
                                <h5 for="content">Tags:</h5>
                                @foreach ($tags as $tag)
                                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                        name="tags[]" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                                    <div class="form-check-label">{{ $tag->name }}</div>
                                @endforeach
                                @error('tags')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / Tags --}}

                            <div class="form-group">
                                <input type="submit" class="btn btn-success white" value="Modifica Post">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
