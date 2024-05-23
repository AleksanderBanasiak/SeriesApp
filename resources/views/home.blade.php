@extends('layouts.app')

@section('content')
<div class="container" style="color: white;">

    <div class="serachDiv">
        <form action="/home " method="get" class="serachBar">
            <input type="text" class="form-controll w-100" placeholder="  serach series" autocomplete="off" name="search">
            <button class="btn btn-dark mt-2">Serach</button>    
        </form>
    </div>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    


    @foreach($series as $singleSeries)
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
                   <div class="bootomRating">
                    <p class="mt-3 fs-5">Średnia ocena: 
                        @php
                            $rating = $ratings[$singleSeries->id] ?? null;
                            $roundedRating = round($rating); 
                        @endphp
                        @if($rating)
                            @for ($i = 1; $i <= 5; $i++)
                                @if($i <= $roundedRating)
                                    <i class="fas fa-star" style="color: #ffc107;"></i>
                                @else
                                    <i class="fas fa-star"></i>
                                @endif
                            @endfor
                        @else
                            Brak ocen
                        @endif
                    </p>

                    @if($user != null)
                    <form action="{{ route('rating.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="series_id" value="{{ $singleSeries->id }}">
                        
                        <div class="yourRating">
                           
                        <p class="rating2"> Twoja ocena:</p>
                        <p class=" rating">
                        @if($userRatings[$singleSeries->id] == null)
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}_{{ $singleSeries->id }}" name="rating" value="{{ $i }}" data-rating="{{ $i }}">
                                <label for="star{{ $i }}_{{ $singleSeries->id }}" class="mt-3 fs-5"> <i class="fas fa-star" data-rating="{{ $i }}"></i></label>
                            @endfor
                           
                        </p> 
                        <button type="submit" class="addPlus"><i class="fa-solid fa-plus "></i></button>
                        @else
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}_{{ $singleSeries->id }}" name="rating" value="{{ $i }}" data-rating="{{ $i }}" {{ $userRatings[$singleSeries->id] == $i ? 'checked' : '' }}>
                            <label for="star{{ $i }}_{{ $singleSeries->id }}" class="mt-3 fs-5"> <i class="fas fa-star" data-rating="{{ $i }}"></i></label>
                        @endfor
                           
                        </p> 
                        
                        @endif
                        </div>

                        
                    </form>
                    @endif
                    </div>
                   
                </div>
            </div>
        </div>
    @endforeach
    <div class="paginator">
    {{$series->links()}}
    </div>
</div>



@endsection
