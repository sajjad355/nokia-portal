<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    {{--Favicon--}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">

    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"
        integrity="sha256-YcbK69I5IXQftf/mYD8WY0/KmEDCv1asggHpJk1trM8=" crossorigin="anonymous"></script>

    <title>Succesully Payment</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12" style="position:relative">
            <div id="popUp" style="position:absolute; height: 100%; width:100%; left:0; right:0; top:0; bottom:0; z-index:12; background-color:rgba(0,0,0,0.2);display:none;justify-content:center;align-items:center">
                <div id="popUpInternal" style="height:300px; width:500px; padding:30px; ">
                     <p id="popUpPara">
                          
                     </p>
                </div>
            </div>
            <div class="card mt-5">
                
                <div class="card-header" style="background-color:blue">
                <span style="color:white">Payment Completed Successfully.</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Transaction Status: {{$_GET['transactionStatus']}}
                    <h5  class="card-title">Transaction ID:  {{$_GET['trxID']}}
                    <h5  class="card-title">Merchant Invoice Number:  {{$_GET['merchantInvoiceNumber']}}
                    <h5  class="card-title">Payment ID:  {{$_GET['paymentID']}}
                   <input  hidden name="invoice" id="invoice" value="{{$_GET['merchantInvoiceNumber']}}" > 
                   <input  hidden name="txid" id="txid" value="{{$_GET['trxID']}}" > 




                </div>
                <div class="card-footer" style="background-color:blue">
                <span style="color:white">You will be redirect to the CPP page within 15 seconds. </span>
           </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function () {

    var invoice=document.getElementById("invoice").value;  
    var txid=document.getElementById("txid").value;  

    // console.log(txid);

    // console.log(invoice);
    

setTimeout(() => {
    var url = '{{ route("successStore", ":invoice") }}';
    url = url.replace(':invoice', invoice);
    window.location.href=url;
}, 15000);

});

    </script>

</body>
</html>