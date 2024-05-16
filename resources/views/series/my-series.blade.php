@extends('layouts.app')

@section('content')
<div class="container">


@foreach($user->series as $singleSeries)
<div class="row m-5" style="border-radius: 20px; padding: 10px; background-color: #4764A3; color: white;">
            <div class="col-md-4">
                <img src="/storage/{{ $singleSeries->image }}" alt="{{ $singleSeries->name }}" class="w-100">
            </div>
            <div class="col-md-8 row ">
                <div class="col-md-8 description">
                    <p class="mt-3 fs-1 fw-bold">{{ $singleSeries->name }}</p>
                    <p class="mt-5 fs-5 ">Opis: {{ $singleSeries->description }}</p>
                </div>
                <div class="col-md-4 allRating">
                    <div class="topRating">
                        <p class="mt-3 fs-5">Rok wydania: {{ $singleSeries->yearOfRelease }}</p>
                        <p class="mt-3 fs-5">Liczba sezonów: {{ $singleSeries->numberOfSeasons }}</p>
                    </div>  
                   <div class="bootomRating2">
                    <a href="/my-series/{{ $singleSeries->id}}/edit" class="delButton">Edit</a>

                    <form action="/my-series/{{ $singleSeries->id}}/delete" method="post" class="delButton">
                        @csrf
                        <button type="submit">Delete</button>
                    </form>

                    </div>
                   
                </div>
            </div>
        </div>

   

    @endforeach
</div>
@endsection
