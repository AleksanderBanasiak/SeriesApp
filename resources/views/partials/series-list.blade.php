<div id="seriesContainer">
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
                    <!-- Oceny i formularze jak w głównym kodzie -->
                </div>
            </div>
        </div>
    @endforeach
    <div class="paginator">
        {{$series->links()}}
    </div>
</div>
