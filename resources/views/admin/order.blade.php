@extends('admin.menu')
@section('transaction')
    <section class="rounded-3xl gap-y-4 flex flex-col p-6 bg-white">
        <h1 class="text-3xl font-bold text-black">Cart</h1>
        <div class="gap-y-2 flex flex-col">
            <form action="" class="gap-y-2 flex flex-col">
                <div class="gap-y-2 flex flex-col">
                    <label for="dine" class="font-extraalight text-black">Where to Eat</label>
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
