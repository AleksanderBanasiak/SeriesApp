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
                <p class="mt-5 fs-5">Opis: {{ $singleSeries->description }}</p>
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
                    <form id="ratingForm_{{ $singleSeries->id }}" class="ratingForm" data-series-id="{{ $singleSeries->id }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="series_id" value="{{ $singleSeries->id }}">
                        <div class="yourRating">
                            <p class="rating2">Twoja ocena:</p>
                            <p class="rating">
                                @if($userRatings[$singleSeries->id] == null)
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}_{{ $singleSeries->id }}" name="rating" value="{{ $i }}" class="ratingInput">
                                        <label for="star{{ $i }}_{{ $singleSeries->id }}" class="mt-3 fs-5"> 
                                            <i class="fas fa-star" data-rating="{{ $i }}"></i>
                                        </label>
                                    @endfor
                                @else
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}_{{ $singleSeries->id }}" name="rating" value="{{ $i }}" class="ratingInput" {{ $userRatings[$singleSeries->id] == $i ? 'checked' : '' }}>
                                        <label for="star{{ $i }}_{{ $singleSeries->id }}" class="mt-3 fs-5"> 
                                            <i class="fas fa-star" data-rating="{{ $i }}"></i>
                                        </label>
                                    @endfor
                                @endif
                            </p> 
                        </div>
                    </form>
                    @endif
                    @if($user != null)
                    @php
                        $isSaved = $user->savedSeries->contains('series_id', $singleSeries->id);
                    @endphp
                    <button class="btn btn-success saveSeriesBtn" 
                            data-series-id="{{ $singleSeries->id }}" 
                            data-user-id="{{ auth()->user()->id }}"
                            @if($isSaved) disabled @endif>
                        @if($isSaved)
                            Serial zapisany
                        @else
                            Zapisz serial
                        @endif
                    </button>
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

<script>
    $(document).ready(function () {
        $('.saveSeriesBtn').on('click', function () {
            var seriesId = $(this).data('series-id');
            var userId = $(this).data('user-id');
            var button = $(this);
            
            $.ajax({
                url: '/save-series',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId,
                    series_id: seriesId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        button.text('Serial zapisany').prop('disabled', true);
                    } else {
                        alert('Coś poszło nie tak, spróbuj ponownie.');
                    }
                },
                error: function () {
                    alert('Błąd AJAX, spróbuj ponownie.');
                }
            });
        });
    });
</script>

@endsection
