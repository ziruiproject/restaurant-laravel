@extends('app')

@section('content')
<section class="flex justify-center h-screen">
    <div class="gap-y-4 flex flex-col">
        <img class="aspect-square" src="{{ asset('storage/'.$food->images()->first()->path) }}" alt="">
        <div class="gap-y-4 flex flex-col">
            <h3 class="text-4xl font-extrabold">{{$food->name}}</h3>
            <h3 class="text-3xl font-bold">{{'Rp' . number_format($food->price, 0, '.', '.')}}</h3>
            <p class="font-semibold">{{$food->description}}</p>
            <form method="post" action="{{ route('transaction.create') }}">
                @csrf
                <input type="hidden" name="id" value="{{$food->id}}">
                <input type="hidden" name="price" value="{{$food->price}}">
                <button type="submit" class="shadow-md rounded-2xl w-full py-4 text-lg font-bold text-center bg-yellow-400">
                    Tambah Pesanan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
