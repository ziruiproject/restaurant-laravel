@extends('app')
@section('content')
<section>
    <h1 class=" pb-8 text-4xl font-bold">Keranjang</h1>
    @foreach ((array) session('cart') as $id => $details)
    <div class="gap-x-4 flex py-3">
        <img class="aspect-square h-32 rounded-lg" src="{{ asset('storage/'. $details['image']) }}" alt="">
        <div class="gap-y-2 flex flex-col w-full">
            <span class="text-3xl font-extrabold text-gray-700">{{$details['name']}}</span>
            <span class="text-2xl text-gray-700">{{'Rp' . number_format($details['price'], 0, '.', '.')}}</span>
            <div class="w-fit gap-x-2 flex self-end">
                <button class={{"min-amount" . $id}}>
                    <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg" color="#C2BBBD">
                        <path d="M8 12H16" stroke="#C2BBBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                            stroke="#C2BBBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <span id={{"amount" . $id}} class="py-2 text-xl font-bold text-center">{{$details['amount']}}</span>
                <button class={{"add-amount" . $id}}>
                    <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg" color="#FACC15">
                        <path d="M8 12H12M16 12H12M12 12V8M12 12V16" stroke="#FACC15" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path
                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                            stroke="#FACC15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
<script>
        document.addEventListener("DOMContentLoaded", function() {
                let counterDisplayElem = document.getElementById('amount{{$id}}');
                let counterMinusElem = document.querySelector('.min-amount{{$id}}');
                let counterPlusElem = document.querySelector('.add-amount{{$id}}');
                let count = {{$details['amount']}};
    
                counterPlusElem.addEventListener("click", () => {
                    count++;
                    updateDisplay();
                });
    
                counterMinusElem.addEventListener("click", () => {
                    if (count === 1) {
                        return;
                    }
                    count--;
                    updateDisplay();
                });
    
                function updateDisplay() {
                    counterDisplayElem.innerText = count;
                }
            });
    </script>
    @endforeach
    <div>
        <button>
            
        </button>
    </div>
</section>
@endsection

@section('script')
<script>
    var session = {!! json_encode(session()->get('cart')) !!}

    let counterDisplayElem;
    let counterDisplayElemForm;
    let counterMinusElem;
    let counterPlusElem;
    let totalAmount;

    let count;
</script>
@endsection