@extends('app')

@section('content')
    <section class="bg-background flex justify-center min-h-screen">
        <div class="gap-y-4 flex flex-col">
            <img class="aspect-square rounded-3xl m-2" src="{{ asset('storage/' . $food->images()->first()->path) }}"
                alt="">
            <div class="gap-y-4 flex flex-col">
                <div class="flex items-center justify-between align-middle">
                    <h3 class="text-3xl font-bold">{{ $food->name }}</h3>
                    <span class=" text-orange text-xl font-bold">{{ $price }}</span>
                </div>
                <div class="gap-y-2 flex flex-col">
                    <span class="font-medium text-black">Categories</span>
                    <div class="grid grid-cols-5 gap-3">
                        @foreach ($categories as $category)
                            <span
                                class="bg-orange rounded-3xl min-w-fit text-orange-shade px-3 py-2 text-sm text-center">{{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="gap-y-1 flex flex-col">
                    <span class="font-medium text-black">Description</span>
                    <p class="text-darker-gray pb-4 font-light">{{ $food->description }}</p>
                </div>
                <div class="flex items-center justify-between align-middle">
                    <span class="text-xl font-bold">Amount</span>
                    <div class="w-fit gap-x-2 flex items-center self-center justify-center">
                        <button class="min-amount">
                           <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" color="#ec7905" stroke-width="1.5">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM8 11.25C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H8Z"
                                    fill="#ec7905"></path>
                            </svg>
                            </svg>
                        </button>
                        <span id="amount" class="py-2 text-xl font-bold text-center">1</span>
                        <button class="add-amount">
                           <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" color="#ec7905" stroke-width="1.5">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM12.75 8C12.75 7.58579 12.4142 7.25 12 7.25C11.5858 7.25 11.25 7.58579 11.25 8V11.25H8C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H11.25V16C11.25 16.4142 11.5858 16.75 12 16.75C12.4142 16.75 12.75 16.4142 12.75 16V12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H12.75V8Z"
                                            fill="#ec7905"></path>
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
                        class="rounded-3xl bg-orange w-full py-3 text-lg font-bold text-center text-white shadow-md"
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
