@extends('app')

@section('content')
<section class="h-screen">
    <div class="py-2">
        <a href="{{route('cart.show')}}">
            <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg" color="#000000">
                <path
                d="M19.5 22C20.3284 22 21 21.3284 21 20.5C21 19.6716 20.3284 19 19.5 19C18.6716 19 18 19.6716 18 20.5C18 21.3284 18.6716 22 19.5 22Z"
                fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                d="M9.5 22C10.3284 22 11 21.3284 11 20.5C11 19.6716 10.3284 19 9.5 19C8.67157 19 8 19.6716 8 20.5C8 21.3284 8.67157 22 9.5 22Z"
                fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M5 4H22L20 15H7L5 4ZM5 4C4.83333 3.33333 4 2 2 2" stroke="#000000" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M20 15H7H5.23077C3.44646 15 2.5 15.7812 2.5 17C2.5 18.2188 3.44646 19 5.23077 19H19.5" stroke="#000000"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </a>
    </div>
    <div class="gap-y-3 flex flex-col pb-4">
        <div class="gap-x-2 grid grid-cols-4">
            @foreach ($categories as $category)
            <a href="" class="bg-gray rounded-3xl min-w-fit text-darker-gray px-3 py-2 text-center">
                {{$category->name}}
            </a>
            @endforeach
        </div>
        <h1 class="text-2xl font-bold text-black">Choose Menu</h1>
    </div>
    <div class="auto-rows-fr grid grid-flow-row grid-cols-2 gap-4">
        @foreach ($foods as $food)
            <a href="{{route('food.show', ['id' => $food->id])}}" class="gap-y-2 rounded-3xl flex flex-col items-center p-3 pb-6 bg-white">
                <img class="aspect-square w-fit rounded-full" src="{{ asset('storage/'.$food->images()->first()->path) }}" alt="">
                <div class="flex flex-col pt-4">
                    <h3 class="text-xl font-bold text-center text-black">{{$food->name}}</h3>
                    <span class="text-orange text-xl font-bold text-center">{{"Rp" . number_format($food->price, 0, '.', '.')}}</span>
                    <span class="text-md text-darker-gray pt-3 font-normal text-center">Available</span>
                </div>
            </a>
            
        @endforeach
    </div>
</section>
@endsection
