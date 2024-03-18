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
                        <span class="py-2 font-light text-black">{{ 'Amount: ' . $details['amount'] }}</span>
                    </div>
                </div>
            @endforeach
            <div class="gap-y-2 shadow-full rounded-t-3xl fixed bottom-0 left-0 flex flex-col w-full p-4 pt-8 bg-white border-none">
                <span id="total" class="text-xl font-medium text-black">Total =
                    {{ 'Rp' . number_format(session('total'), 0, '.', '.') }}
                </span>
                <button id="pay-button" class="rounded-3xl bg-orange w-full py-3 text-lg font-bold text-center text-white shadow-md">
                    Bayar
                </button>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $transaction->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href =
                        '{{ route('transaction.success', ['id' => $transaction->order_id]) }}'
                },
                // Optional
                onPending: function(result) {},
                // Optional
                onError: function(result) {
                    window.location.href =
                        '{{ route('transaction.failed', ['id' => $transaction->order_id]) }}'
                }
            });
        };
    </script>
@endsection
