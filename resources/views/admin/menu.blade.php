@extends('admin.dashboard')
@section('db.content')
    <section class="bg-background grid w-full h-full p-8 overflow-y-auto">
        <section>
            <div class="gap-y-4 flex flex-col pb-4">
                <div class="gap-x-6 flex items-center justify-between w-1/3">
                    <form action="{{ route('food.search') }}" class="relative w-full">
                        <div class="left-[90%] absolute inset-y-0 flex items-center pointer-events-none">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" stroke-width="1.5" fill="none"
                                xmlns="http://www.w3.org/2000/svg" color="#7f7f7f">
                                <path d="M17 17L21 21" stroke="#7f7f7f" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M3 11C3 15.4183 6.58172 19 11 19C13.213 19 15.2161 18.1015 16.6644 16.6493C18.1077 15.2022 19 13.2053 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11Z"
                                    stroke="#7f7f7f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <input type="text" name="name" placeholder="Search Category or Menu"
                            class="focus:ring-orange-shade outline-orange-shade w-full px-6 py-4 text-lg font-light rounded-full">
                    </form>
                </div>
                <div class="gap-x-4 flex w-full">
                    @foreach ($categories as $category)
                        <a href="" class="bg-gray text-darker-gray px-8 py-2 text-lg text-center rounded-full">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
                <h1 class="text-3xl font-bold text-black">Choose Menu</h1>
            </div>
            <div class="auto-rows-fr grid grid-flow-row grid-cols-2 gap-4">
                @foreach ($foods as $food)
                    <a href="{{ route('food.show', ['id' => $food->id]) }}"
                        class="gap-y-2 rounded-3xl flex flex-col items-center p-3 pb-6 bg-white">
                        <img class="aspect-square h-auto rounded-full"
                            src="{{ asset('storage/' . $food->images()->first()->path) }}" alt="">
                        <div class="flex flex-col pt-4">
                            <h3 class="text-xl font-bold text-center text-black">{{ $food->name }}</h3>
                            <span
                                class="text-orange text-xl font-bold text-center">{{ 'Rp' . number_format($food->price, 0, '.', '.') }}</span>
                            <span class="text-md text-darker-gray pt-3 font-normal text-center">Available</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <section>
            <h1>Halo</h1>
            <h1>Halo</h1>
        </section>
    </section>
@endsection
