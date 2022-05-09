@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <form class="float-end" action="{{ route('admin.movies.store') }}" method="POST">
            @csrf
            <div class="input-group pl-5">
                <input type="number" name="tmdb_id" class="form-control" placeholder="TMDB ID" autocomplete="off" required>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-end">Goş</button>
            </div>
        </form>
        <livewire:tables.movie-table/>
    </div>
@endsection
