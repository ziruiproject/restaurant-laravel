@extends('app')

@section('content')
<section class="gap-y-4 flex flex-col p-8">
    <h1 class="text-4xl font-bold">Makanan</h1>
    @foreach ($foods as $food)
    <div class="gap-y-2 w-72 flex flex-col">
        <img class="w-64" src="{{ asset('storage/'.$food->images()->first()->path) }}" alt="">
        <h3 class="text-xl">{{$food->name}}</h3>
        <h3 class="text-xl">{{$food->price}}</h3>
        <a href="{{route('food.show', ['id' => $food->id])}}" class="rounded-xl px-4 py-2 text-2xl font-bold text-white bg-red-400">Lihat Menu</a>
    </div>
    @endforeach
</section>
@endsection
