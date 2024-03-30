@extends('admin.dashboard')
@section('db.content')
    <section class="bg-background grid w-full h-full grid-cols-[2fr,1fr] p-8 overflow-y-auto gap-x-8">
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
                                    stroke="#7f7f7f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
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
            <div class="auto-rows-fr md:grid-cols-4 gap-x-6 grid grid-flow-row grid-cols-2">
                @foreach ($foods as $food)
                    <a href="{{ route('food.show', ['id' => $food->id]) }}"
                        class="gap-y-2 rounded-3xl flex flex-col items-center px-3 py-6 bg-white">
                        <img class="aspect-square h-auto md:h-[150px] rounded-full"
                            src="{{ asset('storage/' . $food->images()->first()->path) }}" alt="">
                        <div class="flex flex-col pt-4">
                            <h3 class="md:text-2xl text-xl font-bold text-center text-black">{{ $food->name }}</h3>
                            <span
                                class="text-orange text-xl font-bold text-center">{{ 'Rp' . number_format($food->price, 0, '.', '.') }}</span>
                            <span class="text-md text-darker-gray py-3 font-normal text-center">Available</span>
                        </div>
                        <form method="post" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $food->id }}">
                            <input type="hidden" name="amount" id="amount-form" value="1">
                            <input type="hidden" name="price" value="{{ $food->price }}">
                            <button type="submit" id="total-amount"
                                class="rounded-3xl bg-orange w-full px-6 py-3 text-lg font-bold text-center text-white shadow-md">
                                Add to Cart
                            </button>
                        </form>
                    </a>
                @endforeach
            </div>
        </section>
        {{-- ORDERS --}}
        <section class="rounded-3xl gap-y-4 flex flex-col p-6 bg-white">
            <h1 class="text-3xl font-bold text-black">Cart</h1>
            <div class="gap-y-2 flex flex-col">
                <form action="" class="gap-y-2 flex flex-col">
                    <div class="gap-y-2 flex flex-col">
                        <label for="dine" class="font-extralight text-black">Where to Eat</label>
                        <select name="dine" id="dine" class="order-option">
                            <option value="0">Dine In</option>
                            <option value="1">Take Away</option>
                        </select>
                    </div>
                    <div class="gap-y-2 flex flex-col">
                        <label for="table" id="lable-table" class="font-extralight text-black">Choose Table</label>
                        <select name="table" id="table" class="order-option">
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}">{{ $table->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 bg-white divide-y">
                @foreach ((array) session('cart') as $id => $details)
                    <div class="gap-x-4 flex py-3">
                        <div class="bg-orange-shade min-w-max h-fit rounded-2xl p-2">
                            <img class="aspect-square h-16 rounded-full" src="{{ asset('storage/' . $details['image']) }}"
                                alt="">
                        </div>
                        <div class="flex flex-col w-full">
                            <span class="text-xl font-semibold text-black">{{ $details['name'] }}</span>
                            <span
                                class="text-lg font-medium text-black">{{ 'Rp' . number_format($details['price'], 0, '.', '.') }}</span>
                            <div class="w-fit gap-x-2 flex self-start" data-id="{{ $id }}">
                                <button class={{ 'min-amount' . $id }}>
                                    <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        color="#ec7905" stroke-width="1.5">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM8 11.25C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H8Z"
                                            fill="#ec7905"></path>
                                    </svg>
                                </button>
                                <span id={{ 'amount' . $id }}
                                    class="amount update-cart py-2 text-xl font-bold text-center">{{ $details['amount'] }}</span>
                                <button class={{ 'add-amount' . $id }} class="focus:outline-none">
                                    <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        color="#ec7905" stroke-width="1.5">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM12.75 8C12.75 7.58579 12.4142 7.25 12 7.25C11.5858 7.25 11.25 7.58579 11.25 8V11.25H8C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H11.25V16C11.25 16.4142 11.5858 16.75 12 16.75C12.4142 16.75 12.75 16.4142 12.75 16V12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H12.75V8Z"
                                            fill="#ec7905"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let counterDisplayElem = document.getElementById('amount{{ $id }}');
                            let totalElem = document.getElementById('total');
                            let counterMinusElem = document.querySelector('.min-amount{{ $id }}');
                            let counterPlusElem = document.querySelector('.add-amount{{ $id }}');
                            let count = {{ $details['amount'] }};
                            let total = {{ session('total') }}

                            counterPlusElem.addEventListener("click", () => {
                                count++;
                                total += {{ $details['price'] }}
                                updateDisplay();
                            });

                            counterMinusElem.addEventListener("click", () => {
                                if (count === 1) {
                                    return;
                                }

                                count--;
                                total -= {{ $details['price'] }}
                                updateDisplay();
                            });

                            function updateDisplay() {
                                counterDisplayElem.innerText = count;
                                totalElem.innerText = "Total = " + formatCurrency(total)
                                updateSessionCount(count)
                            }

                            function updateSessionCount(count) {
                                fetch('{{ route('cart.update') }}', {
                                        method: 'PATCH',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            id: {{ $id }},
                                            amount: count,
                                            total: total
                                        })
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            }

                            function formatCurrency(amount) {
                                return "Rp" + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        });
                    </script>
                @endforeach
            </div>

            <div class="gap-y-2 flex flex-col w-full p-4 pt-8">
                <span id="total" class="text-xl font-medium text-black">Total =
                    {{ 'Rp' . number_format(session('total'), 0, '.', '.') }}
                </span>
                <form method="post" action="{{ route('transaction.create') }}">
                    @csrf
                    <input type="text" name="dine" id="hidden-dine" value="0" class="hidden">
                    <input type="text" name="table" id="hidden-table" value="1" class="hidden">
                    <button type="submit" id="total-amount"
                        class="rounded-3xl bg-orange w-full py-3 text-lg font-bold text-center text-white shadow-md">
                        Checkout
                    </button>
                </form>
            </div>
        </section>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let dineSelect = document.getElementById('dine');
            let tableSelect = document.getElementById('table');
            let hiddenDineSelect = document.getElementById('hidden-dine');
            let hiddenTableSelect = document.getElementById('hidden-table');
            let lableTableSelect = document.getElementById('lable-table');

            dineSelect.addEventListener('change', function() {
                hiddenDineSelect.innerText = dineSelect.value;

                if (dineSelect.value === '1') {
                    tableSelect.style.display = 'none';
                    lableTableSelect.style.display = 'none';
                } else {
                    tableSelect.style.display = 'block';
                    lableTableSelect.style.display = 'block';
                }
            });

            tableSelect.addEventListener('change', function() {
                hiddenTableSelect.value = tableSelect.value;
                console.log("showed: " + tableSelect.value)
                console.log("hidden: " + hiddenTableSelect.value)
            });

            // Trigger initial check
            if (dineSelect.value === '1') {
                tableSelect.style.display = 'none';
            }
        });
    </script>
@endsection
