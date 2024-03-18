@extends('app')
@section('content')
    <section class="relative flex flex-col min-h-screen">
        <h1 class="text-2xl font-bold text-black">Cart</h1>
        <div class="bg-background grid grid-cols-1 divide-y">
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
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#ec7905"
                                    stroke-width="1.5">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM8 11.25C7.58579 11.25 7.25 11.5858 7.25 12C7.25 12.4142 7.58579 12.75 8 12.75H16C16.4142 12.75 16.75 12.4142 16.75 12C16.75 11.5858 16.4142 11.25 16 11.25H8Z"
                                        fill="#ec7905"></path>
                                </svg>
                            </button>
                            <span id={{ 'amount' . $id }}
                                class="amount update-cart py-2 text-xl font-bold text-center">{{ $details['amount'] }}</span>
                            <button class={{ 'add-amount' . $id }} class="focus:outline-none">
                                <?xml version="1.0" encoding="UTF-8"?><svg width="24px" height="24px"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#ec7905"
                                    stroke-width="1.5">
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
        <div class="gap-y-2 shadow-full rounded-t-3xl fixed bottom-0 left-0 flex flex-col w-full p-4 pt-8 bg-white">
            <span id="total" class="text-xl font-medium text-black">Total =  
                {{ 'Rp' . number_format(session('total'), 0, '.', '.') }}
            </span>
            <form method="post" action="{{ route('transaction.create') }}">
                @csrf
                <button type="submit" id="total-amount"
                class="rounded-3xl bg-orange w-full py-3 text-lg font-bold text-center text-white shadow-md">
                Checkout
            </button>
        </form>
    </div>
    </section>
@endsection

@section('script')
@endsection
