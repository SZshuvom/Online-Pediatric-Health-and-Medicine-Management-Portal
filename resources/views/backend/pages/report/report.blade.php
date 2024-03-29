@extends('backend.master')

@section('content')
<div class="container">
<div class="container">
<div class="container">
    

<br><h1>Order Report</h1><br>

<form action="{{route('order.report.search')}}" method="get">

<div class="row">
    <div class="col-md-4">
        <label for="">From date:</label>
        <input name="from_date" type="date" class="form-control">

    </div>
    <div class="col-md-4">
        <label for="">To date:</label>
        <input name="to_date" type="date" class="form-control">
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-success">Search</button>
    </div>
</div>

</form>
<br><div id="orderReport">

<h1>Order Reports- {{date('Y-m-d')}}</h1><br>
    <table class="table table-striped">
        <thead>
        <tr>

            <th scope="col">SL</th>
            <th scope="col">Product</th>
            <th scope="col">Total</th>
            <th scope="col">F Name</th>
            <th scope="col">L Name</th>
            <th scope="col">City</th>
            <th scope="col">Address</th>
            <th scope="col">Postcode</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Note</th>
            <th scope="col">Status</th>
          

        </tr>
        </thead>
        <tbody>


        @if(isset($orders))
        @foreach($orders as $key=>$order)
        <tr>

            <th scope="row">{{ $key+1 }}</th>
            <td>{{ $order->name }}</td>
            <td>{{ $order->amount }} Tk.</td>
            <td>{{ $order->first_name }}</td>
            <td>{{ $order->last_name }}</td>
            <td>{{ $order->address }}</td>
            <td>{{ $order->city }}</td>
            <td>{{ $order->postcode }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->email }}</td>
            <td>{{ $order->note }}</td>
            <td class="text-danger">Processing</td>

        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</div>
<button onclick="printDiv('orderReport')" class="btn btn-success">Print</button>
</div></div></div>

<script>
    function printDiv(divId){
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

@endsection
