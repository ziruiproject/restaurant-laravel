@extends('app')

@section('content')
<section>
    <div class="flex flex-col">
        <span>Anda akan membeli 
            <span class="font-bold">
                {{$transaction->name}}
            </span>
             seharga 
            <span class="font-bold">
                Rp{{$transaction->price}}
            </span>
        </span>
        <button id="pay-button" class="bg-red-400 text-white px-4 py-2 rounded-xl text-2xl font-bold text-center">
            Bayar
        </button>
    </div>
</section>
@endsection

@section('script')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{$transaction->snap_token}}', {
            // Optional
            onSuccess: function(result){
                console.log(result);
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onPending: function(result){
                console.log(result);
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
                console.log(result);
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
        };
</script>
@endsection