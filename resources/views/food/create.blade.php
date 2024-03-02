@extends('app')
@section('content')

<section class=" flex flex-col items-center justify-center h-screen gap-20">
    <h1 class="font-bold text-4xl">Create Food</h1>
    <form method="post" action="{{route('food.store')}}" class="flex flex-col gap-y-2" enctype="multipart/form-data">
        @csrf
        <label for="name">Nama Menu:</label>
        <input type="text" name="name" class="py-2 px-4 outline outline-2 ring-red-400 outline-red-400 rounded-xl">
        <label for="price">Harga:</label>
        <input type="text" name="price" class="py-2 px-4 outline outline-2 ring-red-400 outline-red-400 rounded-xl">
        <label for="description">Deskripsi:</label>
        <input type="textarea" name="description" class="py-2 px-4 outline outline-2 ring-red-400 outline-red-400 rounded-xl">
        <label for="image">Harga:</label>
        <input type="file" name="image">
        <button type="submit">Buat</button>
    </form>

</section>


@endsection