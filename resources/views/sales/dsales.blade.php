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

    <title>Pay with bKash</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header" style="background-color:blue">
                  <span style="color:white">  NOKIA</span>
                </div>
                <div class="card-body">

                <h5  class="card-title">Product:
                    <span class="card-text" >{{ $service }} </span><h5>
                    <h5 class="card-title">CPP Price: BDT
                    <span class="card-text amount">{{ $salesInfo }}</span></h5>
                    <span hidden class="card-text imei">{{ $imei }}</span></h5>

                    <h5  class="card-title">Invoice:
                    <span class="card-text invoice" >{{ $invoice }}</span><h5>

                    <button class="btn" id="bKash_button" style="border:none;"><img style="height: 60px; width: 200px;  display: inline-block; margin-left: -20px!important; vertical-align: top;" src="{{asset('assets/bkashPayment.png')}}"></button>
                    <a href="{{ route('sales.create') }}">Go Back</a>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-1.8.3.min.js"
        integrity="sha256-YcbK69I5IXQftf/mYD8WY0/KmEDCv1asggHpJk1trM8=" crossorigin="anonymous"></script>

<script id="myScript"
        src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>

        

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    var accessToken = '';
    var paymentID='';
    $(document).ready(function () {

        var imei= $('.imei').text();
        var invoice= $('.invoice').text();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{!! route('token') !!}",
            type: 'POST',
            contentType: 'application/json',
            // success: function (data) {
            //     // console.log('got data from token  ..');
            //     // console.log(JSON.stringify(data));
            //     clearconsole();
            //     accessToken = JSON.stringify(data);
            // },
            // error: function () {
            //     console.log('error');
            // }
        });
        var paymentConfig = {
            createCheckoutURL: "{!! route('createpayment') !!}",
            executeCheckoutURL: "{!! route('executepayment') !!}",
            bkashquerypayment: "{!! route('bkash-query-payment') !!}"
        };
        var paymentRequest;
        paymentRequest = {amount:$('.amount').text(), intent: 'sale', invoice: $('.invoice').text()};

        // console.log(JSON.stringify(paymentRequest));
        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: paymentRequest,
            createRequest: function (request) {
                $.ajax({
                    url: paymentConfig.createCheckoutURL,
                    type: 'POST',
                    data: {
                    invoice: paymentRequest.invoice
                    },
                    success: function (data) {
                        // console.log('got data from create  ..');
                        // console.log('data ::=>');
                        // console.log(JSON.stringify(data));
                        clearconsole();
                        var obj = JSON.parse(data);
                        if (data && obj.paymentID != null) {
                            paymentID = obj.paymentID;
                            bKash.create().onSuccess(obj);
                        }
                        else {
                            // console.log(data);
                            bKash.create().onError();
                        }
                    },
                    error: function (e) {
                        // console.log(e.error);
                        bKash.create().onError();
                    }
                });
            },
            executeRequestOnAuthorization: function () {
                // console.log('=> executeRequestOnAuthorization');
                try{

                $.ajax({
                    url: paymentConfig.executeCheckoutURL,
                    type: 'POST',
                    data: {
                    paymentID: paymentID,
                    },                    
                    success: function (data) {
                    // console.log(data);
                        if (data) {
                        // console.log('got data from execute  ..');
                        // console.log('data ::=>');
                        data= JSON.parse(data)
                        if (data.transactionStatus === "Completed" && data.trxID) {
                            // clearconsole();

                            $.post('{{ route('bkash-success') }}', data,function() {
                            window.location.href='/success?transactionStatus='+data.transactionStatus+'&trxID='+data.trxID+'&merchantInvoiceNumber='+data.merchantInvoiceNumber+'&paymentID='+data.paymentID;      
                            // console.log("Successfully Paid");
                            })      
                         }
                        else{
                            // console.log("Not Paid");
                            showErrorMessage(data);
                            bKash.execute().onError();
                        }
                    }
                    else {
                        // console.log("Query Payment");
                        $.ajax({    
                            url: paymentConfig.bkashquerypayment + "?paymentID=" + paymentID,
                            type: 'GET',
                           contentType: 'application/json',
                               success: function (data) {
                            
                               if (data) {
                                data= JSON.parse(data)
                        if (data.transactionStatus === "Completed" && data.trxID) {
                            clearconsole();

                            $.post('{{ route('bkash-success') }}', data,function() {
                            window.location.href='/success?transactionStatus='+data.transactionStatus+'&trxID='+data.trxID+'&merchantInvoiceNumber='+data.merchantInvoiceNumber+'&paymentID='+data.paymentID;      
                            // console.log("Successfully Paid");
                            })      
                         }
                        else{
                            // console.log("Not Paid");
                            showErrorMessage(data);
                            bKash.execute().onError();
                        }
                    }
                    else{
                        // console.log("Not Paid");
                        showErrorMessage(data);
                        bKash.execute().onError();
                    }

                    
                },
                    error: function () {
                        bKash.execute().onError();
                    }
                });
                }

                    }

                });
                }
                catch(e)
                {
                    // console.log(e);
                }
            },
            onClose: function () {
            window.location.href = "sales";
      },
        });
        // console.log("Right after init ");
    });

    function callReconfigure(val) {
        bKash.reconfigure(val);
    }
    function clickPayButton() {
        $("#bKash_button").trigger('click');
    }

    function BkashSuccess(data) {
        $.post('{{ route('bkash-success') }}', {
            payment_info: data
        }, function (res) {
            location.reload()
        });
    }

    function clearconsole() { 
         console.log(window.console);
         if(window.console || window.console.firebug) {
             console.clear();
        }
    }

    function showErrorMessage(response) {
        let message = response;
        if (response.hasOwnProperty('errorMessage')) {
            let errorCode = parseInt(response.errorCode);
            let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
            ];
            if (bkashErrorCode.includes(errorCode)) {
                message = response.errorMessage
            }
        }
        Swal.fire("Payment Failed!", message, "error").then(function() {
        window.location.href = "sales";
});


    }

</script>
</body>
</html>