@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="card shadow">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title" class="form-control-label">
                                    Ady
                                    <span class="text-danger text-sm">*</span>
                                </label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                       name="title"
                                       id="title"
                                       value="{{ old('title', $movie->title) }}" required>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="overview" class="form-control-label">
                                    Mazmuny
                                    <span class="text-danger text-sm">*</span>
                                </label>
                                <textarea class="form-control @error('overview') is-invalid @enderror"
                                          name="overview" id="overview"
                                          required>{{ old('title', $movie->overview) }}</textarea>

                                @error('overview')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="video" class="form-control-label">
                                    Wideo
                                    <span class="text-danger text-sm">*</span>
                                </label>
                                <input class="form-control @error('video') is-invalid @enderror" type="file"
                                       name="video"
                                       id="video"
                                       accept="video/*">

                                @error('video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success mt-3">
                            <i class="fa fa-pen fa-fw"></i>
                            Üýtget
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
