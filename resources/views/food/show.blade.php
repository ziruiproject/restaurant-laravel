@extends('app')

@section('content')
<section class="flex items-center justify-center h-screen px-4">
    <div class="gap-x-4 flex">
        <img class="w-1/3" src="{{ asset('storage/'.$food->images()->first()->path) }}" alt="">
        <div class="gap-y-4 flex flex-col">
            <h3 class="text-4xl font-bold">{{$food->name}}</h3>
            <h3 class="text-2xl">{{$food->price}}</h3>
            <p>{{$food->description}}</p>
            <form method="post" action="{{ route('transaction.create') }}">
                @csrf
                <input type="hidden" name="id" value="{{$food->id}}">
                <input type="hidden" name="price" value="{{$food->price}}">
                <button type="submit" class="rounded-xl px-4 py-2 text-2xl font-bold text-center text-white bg-red-400">
                    Beli
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
