@foreach($payments as $payment)

    {{$payment}}<br>
    {{$payment->category->name}}<br>
    {{$payment->supplier->name}}<br>
    {{$payment->purchase->total}}<br>
    <hr/>

@endforeach