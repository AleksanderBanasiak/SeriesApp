@extends('layouts.app')

@section('content')
<div class="container" style="color: white;">
    <h1 class="mySeriesUser">Saved Series</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($savedSeries->isEmpty())
        <p>Nie masz zapisanych seriali.</p>
    @else
        @foreach($savedSeries as $singleSeries)
        <div class="row m-5" style="border-radius: 20px; padding: 10px; background-color: #4764A3; color: white;" id="series-{{ $singleSeries->id }}">
            <div class="col-md-4">
                <img src="/storage/{{ $singleSeries->series->image }}" alt="{{ $singleSeries->series->name }}" class="w-100">
            </div>
            <div class="col-md-8 row">
                <div class="col-md-8 description">
                    <p class="mt-3 fs-1 fw-bold">{{ $singleSeries->series->name }}</p>
                    <p class="mt-5 fs-5">Opis: {{ $singleSeries->series->description }}</p>
                </div>
                <div class="col-md-4 allRating">
                    <div class="topRating">
                        <p class="mt-3 fs-5">Rok wydania: {{ $singleSeries->series->yearOfRelease }}</p>
                        <p class="mt-3 fs-5">Liczba sezonów: {{ $singleSeries->series->numberOfSeasons }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3 text-end">
                <button class="btn btn-danger delete-saved-series" data-id="{{ $singleSeries->id }}">Usuń zapisany serial</button>
            </div>
        </div>
        @endforeach
    @endif
</div>

<script>
    $(document).ready(function() {
        
        $('.delete-saved-series').click(function() {
            var seriesId = $(this).data('id');

            if (confirm("Czy na pewno chcesz usunąć ten serial?")) {
                $.ajax({
                    url: '/saved-series/' + seriesId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}', 
                    },
                    success: function(response) {
                        
                        $('#series-' + seriesId).fadeOut(500, function() {
                            $(this).remove();
                        });
                        alert(response.message); 
                    },
                    error: function(xhr) {
                        alert('Coś poszło nie tak. Spróbuj ponownie.');
                    }
                });
            }
        });
    });
</script>

@endsection
