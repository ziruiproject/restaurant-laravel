@extends('app')

@section('content')
    <section>
        <h1>Konfirmasi</h1>
        <div class="flex flex-col">
            @foreach ((array) session('cart') as $id => $details)
                <div class="gap-x-4 flex py-3">
                    <img class="aspect-square h-32 rounded-lg" src="{{ asset('storage/' . $details['image']) }}"
                        alt="">
                    <div class="gap-y-2 flex flex-col w-full">
                        <span class="text-3xl font-extrabold text-gray-700">{{ $details['name'] }}</span>
                        <span
                            class="text-2xl text-gray-700">{{ 'Rp' . number_format($details['price'], 0, '.', '.') }}</span>
                        <div class="w-fit gap-x-2 flex self-end" data-id="{{ $id }}">
                            <span id={{ 'amount' . $id }}
                                class="amount update-cart py-2 text-xl font-bold text-center">{{ $details['amount'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
            <button id="pay-button" class="rounded-xl px-4 py-2 text-2xl font-bold text-center text-white bg-red-400">
                Bayar
            </button>
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
                },
                // Optional
                onPending: function(result) {
                },
                // Optional
                onError: function(result) {
                }
            });
        };
    </script>
@endsection
