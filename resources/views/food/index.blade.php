@extends('app')

@section('content')
<section class="p-8 gap-y-4 flex flex-col">
    <h1 class="text-4xl font-bold">Makanan</h1>
    @foreach ($foods as $food)
    <div class="flex flex-col gap-y-2 w-72">
        <img class="w-64" src="{{ asset('storage/'.$food->image) }}" alt="">
        <h3 class="text-xl">{{$food->name}}</h3>
        <h3 class="text-xl">{{$food->price}}</h3>
        <a href="{{route('food.show', ['id' => $food->id])}}" class="bg-red-400 text-white px-4 py-2 rounded-xl text-2xl font-bold">Lihat Menu</a>
    </div>
    @endforeach
</section>
@endsection
