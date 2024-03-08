@extends('app')

@section('content')
    <section class="flex justify-center h-screen">
        <div class="gap-y-4 flex flex-col">
            <img class="aspect-square" src="{{ asset('storage/' . $food->images()->first()->path) }}" alt="">
            <div class="gap-y-4 flex flex-col">
                <h3 class="text-4xl font-extrabold">{{ $food->name }}</h3>
                <h3 class="text-3xl font-bold">{{ $price }}</h3>
                <p class="pb-4 font-semibold">{{ $food->description }}</p>
                <div class="flex items-center justify-between align-middle">
                    <span class="text-xl font-bold">Jumlah pesanan</span>
                    <div class="w-fit gap-x-2 flex items-center self-center justify-center">
                        <button class="min-amount">
                            <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" stroke-width="1.5"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#C2BBBD">
                                <path d="M8 12H16" stroke="#C2BBBD" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                    stroke="#C2BBBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </button>
                        <span id="amount" class="py-2 text-xl font-bold text-center">1</span>
                        <button class="add-amount">
                            <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" stroke-width="1.5"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#FACC15">
                                <path d="M8 12H12M16 12H12M12 12V8M12 12V16" stroke="#FACC15" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path
                                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                    stroke="#FACC15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <form method="post" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $food->id }}">
                    <input type="hidden" name="amount" id="amount-form" value="1">
                    <input type="hidden" name="price" value="{{ $food->price }}">
                    <button type="submit" id="total-amount"
                        class="rounded-2xl w-full py-4 text-lg font-bold text-center bg-yellow-400 shadow-md">
                        Tambah Pesanan - {{ $price }}
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
        let totalAmount = document.getElementById('total-amount');

        let count = 1;

        updateDisplay();

        counterPlusElem.addEventListener("click", () => {
            count++;
            updateDisplay();
        });

        counterMinusElem.addEventListener("click", () => {
            if (count == 1) {
                return;
            }

            count--;
            updateDisplay();
        });

        function updateDisplay() {
            counterDisplayElemForm.value = count;
            counterDisplayElem.innerText = count;
            totalAmount.innerText = 'Tambah Pesanan - ' + formatCurrency(count * {{ $food->price }})
        };

        function formatCurrency(amount) {
            return "Rp" + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
@endsection
