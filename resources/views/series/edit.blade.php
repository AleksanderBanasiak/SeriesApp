@extends('layouts.app')

@section('content')
<div class="container" >
<div class="createForm">
<form action="/my-series/{{ $series->id}}" enctype="multipart/form-data" method="post" >
    @csrf
    @method('PATCH')
    
    <div class=row >
        <div class="col-8 offset-2" >
        Edit series
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Series Name</label>

                <div class="col-md-6">
                    <input id="name"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name') ?? $series->name }}"
                    required
                    autocomplete="name"
                    autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class=row>
        <div class="col-8 offset-2">
            <div class="row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                <div class="col-md-6">
                    <input id="description"
                    type="text"
                    class="form-control @error('description') is-invalid @enderror"
                    name="description"
                    value="{{ old('description')  ?? $series->description  }}"
                    required
                    autocomplete="description"
                    autofocus>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class=row>
        <div class="col-8 offset-2">
            <div class="row mb-3">
                <label for="yearOfRelease" class="col-md-4 col-form-label text-md-end">Year of release</label>

                <div class="col-md-6">
                    <input id="yearOfRelease"
                    type="text"
                    class="form-control @error('yearOfRelease') is-invalid @enderror"
                    name="yearOfRelease"
                    value="{{ old('yearOfRelease')  ?? $series->yearOfRelease }}"
                    required
                    autocomplete="yearOfRelease"
                    autofocus>
    
                    @error('yearOfRelease')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class=row>
        <div class="col-8 offset-2">
            <div class="row mb-3">
                <label for="numberOfSeasons" class="col-md-4 col-form-label text-md-end">Number of seasons</label>

                <div class="col-md-6">
                    <input id="numberOfSeasons"
                    type="text"
                    class="form-control @error('numberOfSeasons') is-invalid @enderror"
                    name="numberOfSeasons"
                    value="{{ old('numberOfSeasons')   ?? $series->numberOfSeasons }}"
                    required
                    autocomplete="numberOfSeasons"
                    autofocus>
    
                    @error('numberOfSeasons')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>


    <div class="row">
    <div class="col-8 offset-2">
            <div class="row mb-3">
        <label for="image" class="col-md-4 col-form-label text-md-end">Image</label>
        <div class="col-md-6">
        <input type="file" class="form-controll-file" id="image" name="image">
        </div>
        @error('image')
            <strong>{{ $message }}</strong>    
        @enderror
        </div>
        </div>
    </div>

    <div class="row pt-4 col-4" style="margin: auto;">
        <button class="btn btn-primary" style="background-color: #182338">Add new series</button>
    </div>
</form>
</div>
</div>
@endsection
