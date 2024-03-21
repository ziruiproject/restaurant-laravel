@extends('app')
@section('content')

<section class=" flex flex-col items-center justify-center h-screen gap-20">
    <h1 class="text-4xl font-bold">Create Food</h1>
    <form method="post" action="{{route('food.store')}}" class="gap-y-2 flex flex-col" enctype="multipart/form-data">
        @csrf
        <label for="name">Nama Menu:</label>
        <input type="text" name="name" class="outline outline-2 ring-red-400 outline-red-400 rounded-xl px-4 py-2">
        <label for="price">Harga:</label>
        <input type="text" name="price" class="outline outline-2 ring-red-400 outline-red-400 rounded-xl px-4 py-2">
        <label for="description">Deskripsi:</label>
        <input type="textarea" name="description" class="outline outline-2 ring-red-400 outline-red-400 rounded-xl px-4 py-2">
        <label for="image">Gambar</label>
        <input type="file" name="image">
        <button type="submit">Buat</button>
    </form>

</section>

@endsection