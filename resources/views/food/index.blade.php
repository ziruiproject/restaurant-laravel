@extends('app')

@section('content')
<h1>Makanan</h1>

@foreach ($foods as $food)
    <div>
        <h3>{{$food->name}}</h3>
        <h3>{{$food->price}}</h3>
        <img src="{{ asset('storage/'.$food->image) }}" alt="">
        <span>{{ asset('storage/'.$food->image) }}</span>
    </div>
@endforeach
@endsection
