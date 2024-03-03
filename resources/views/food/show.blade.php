@extends('app')

@section('content')
<section class="px-4 flex justify-center items-center h-screen">
    <div class="flex gap-x-4">
        <img class="w-1/3" src="{{ asset('storage/'.$food->image) }}" alt="">
        <div class="flex flex-col gap-y-4">
            <h3 class="text-4xl font-bold">{{$food->name}}</h3>
            <h3 class="text-2xl">{{$food->price}}</h3>
            <p>{{$food->description}}</p>
            <form method="post" action="{{ route('transaction.create') }}">
                @csrf
                <input type="hidden" name="id" value="{{$food->id}}">
                <input type="hidden" name="price" value="{{$food->price}}">
                <button type="submit" class="bg-red-400 text-white px-4 py-2 rounded-xl text-2xl font-bold text-center">
                    Beli
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
