@extends('app')

@section('content')
<section class="">
    <div class="auto-rows-fr grid grid-flow-row grid-cols-2 gap-4">
        @foreach ($foods as $food)
            <a href="{{route('food.show', ['id' => $food->id])}}" class="gap-y-2 flex flex-col bg-gray-100 pb-4">
                <img class="h-64" src="{{ asset('storage/'.$food->images()->first()->path) }}" alt="">
                <h3 class="text-gray-809 text-2xl font-bold text-center">{{$food->name}}</h3>
                <h3 class="text-gray-809 text-xl font-semibold text-center">{{"Rp" . number_format($food->price, 0, '.', '.')}}</h3>
            </a>
            
        @endforeach
    </div>
</section>
@endsection
