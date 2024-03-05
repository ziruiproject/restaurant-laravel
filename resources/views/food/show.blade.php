@extends('app')

@section('content')
<section class="flex justify-center h-screen">
    <div class="gap-y-4 flex flex-col">
        <img class="aspect-square" src="{{ asset('storage/'.$food->images()->first()->path) }}" alt="">
        <div class="gap-y-4 flex flex-col">
            <h3 class="text-4xl font-extrabold">{{$food->name}}</h3>
            <h3 class="text-3xl font-bold">{{'Rp' . number_format($food->price, 0, '.', '.')}}</h3>
            <p class="font-semibold">{{$food->description}}</p>
            <div>
                <button class="min-amount">Kurang</button>
                <span name="amount" class="amount" id="amount">1</span>
                <button class="add-amount">Tambah</button>
            </div>
            <form method="post" action="{{ route('transaction.create') }}">
                @csrf
                <input type="hidden" name="id" value="{{$food->id}}">
                <input type="hidden" name="amount" id="amount-form" value="1">
                <input type="hidden" name="price" value="{{$food->price}}">
                <button type="submit" class="shadow-md rounded-2xl w-full py-4 text-lg font-bold text-center bg-yellow-400">
                    Tambah Pesanan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    let counterDisplayElem = document.getElementById('amount');
    let counterDisplayElemForm = document.getElementById('amount-form');
    let counterMinusElem = document.querySelector('.min-amount');
    let counterPlusElem = document.querySelector('.add-amount');
    
    let count = 1;
    
    updateDisplay();
    
    counterPlusElem.addEventListener("click",()=>{
        count++;
        updateDisplay();
    }) ;
    
    counterMinusElem.addEventListener("click",()=>{
        count--;
        updateDisplay();
    });
    
    function updateDisplay(){
        counterDisplayElem.innerText = count;
        counterDisplayElemForm.value = count;
    };
</script>
@endsection
    