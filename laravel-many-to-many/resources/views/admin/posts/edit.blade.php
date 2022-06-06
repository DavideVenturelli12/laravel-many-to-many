@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {{-- titolo card --}}
                <div class="card">
                    <div class="card-header">Modifica post</div>

                    <div class="card-body">
                        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">

                            @csrf

                            {{-- / titolo post --}}
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Titolo:</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror "
                                    placeholder="Titolo post" value="{{ old($post->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Categoria --}}
                            <div class="form-group">
                                <label>Categoria:</label>
                                <select name="category_id">
                                    <option value="">-- Scegli Categoria --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == old('$category_id', $post->category_id) ? 'selected' : '' }}
                                            selected>
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
                                    {{ old($post->content) }}
                        </textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- / contenuto post --}}

                            <div class="form-group">
                                <input type="submit" class="btn btn-success white" value="Modifica Post">
                            </div>
                        </form>
                    </div>
                </div>
                {{-- link per tornare indietro --}}
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary"> Indietro</a>
                {{-- / link per tornare indietro --}}
            </div>
        </div>
    </div>
@endsection
