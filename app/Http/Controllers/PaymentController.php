<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{
    private $base_url;

    public function __construct()
    {

        $bkash_base_url = 'https://checkout.pay.bka.sh/v1.2.0-beta';  
        $this->base_url = $bkash_base_url;
    }

    public function token()
    {
        session_start();

        $request_token = $this->_bkash_Get_Token();
        $idtoken = $request_token['id_token'];

        $_SESSION['token'] = $idtoken;

        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        $array['token'] = $idtoken;

        $newJsonString = json_encode($array);
        File::put(storage_path() . '/app/public/config.json', $newJsonString);

        // echo $idtoken;
    }

    protected function _bkash_Get_Token()
    {
        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        $post_token = array(
            'app_key' => $array["app_key"],
            'app_secret' => $array["app_secret"]
        );

        $url = curl_init($array["tokenURL"]);
        $proxy = $array["proxy"];
        $posttoken = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'password:' . $array["password"],
            'username:' . $array["username"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);

        //curl_setopt($url, CURLOPT_PROXY, $proxy);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    protected function _get_config_file()
    {
        $path = storage_path() . "/app/public/config.json";
        return json_decode(file_get_contents($path), true);
    }

    public function createpayment(Request $request)
    {
        session_start();



        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/
        $array = $this->_get_config_file();

        // $amount = $_GET['amount'];
        // $invoice = $_GET['invoice']; // must be unique
        // $amount = $amount;
        $invoice = $request->invoice;
        $amount=DB::table('sales')
        ->select('cpp_price')
        ->where('invoice', '=', $request->invoice)
        ->pluck('cpp_price')
        ->first();

        $intent = "sale";
        $proxy = $array["proxy"];
        $createpaybody = array('amount' => $amount, 'currency' => 'BDT', 'merchantInvoiceNumber' => $invoice, 'intent' => $intent);
        $url = curl_init($array["createURL"]);

        $createpaybodyx = json_encode($createpaybody);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $array["token"],
            'x-app-key:' . $array["app_key"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $createpaybodyx);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);

        //curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdata = curl_exec($url);
        curl_close($url);
        echo $resultdata;
    }

    public function executepayment(Request $request)
    {
        session_start();

        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        // $paymentID = $_GET['paymentID'];
        $paymentID = $request->paymentID;

        $proxy = $array["proxy"];

        $url = curl_init($array["executeURL"] . $paymentID);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $array["token"],
            'x-app-key:' . $array["app_key"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);

        // curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdatax = curl_exec($url);
        curl_close($url);

        // $this->_updateOrderStatus($resultdatax);

        echo $resultdatax;
    }


    public function queryPayment(Request $request)
    {
        session_start();

        $array = $this->_get_config_file();

        $paymentID = $_GET['paymentID'];

        $url = curl_init("$this->base_url/checkout/payment/query/" . $paymentID);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $array["token"],
            'x-app-key:' . $array["app_key"]
        );


        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);

        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }


    public function bkashSuccess(Request $request)
    {
        // IF PAYMENT SUCCESS THEN YOU CAN APPLY YOUR CONDITION HERE
        if ('Noman' == 'success') {

            // THEN YOU CAN REDIRECT TO YOUR ROUTE

            Session::flash('successMsg', 'Payment has been Completed Successfully');

            return response()->json(['status' => true]);
        }

        Session::flash('error', 'Noman Error Message');

        return response()->json(['status' => false]);
    }

    // public function indexRefund()
    // {
    //     return view('bkash-refund');
    // }


    // public function refund(Request $request)
    // {

    //     $array = $this->_get_config_file();

    //     // (new BkashController())->getToken();

    //     // $token = session()->get('bkash_token');

    //     $token = $array["token"];

    //     $this->validate($request, [
    //         'payment_id' => 'required',
    //         'amount' => 'required',
    //         'trx_id' => 'required',
    //         'sku' => 'required|max:255',
    //         'reason' => 'required|max:255'
    //     ]);

    //     $post_fields = [
    //         'paymentID' => $request->payment_id,
    //         'amount' => $request->amount,
    //         'trxID' => $request->trx_id,
    //         'sku' => $request->sku,
    //         'reason' => $request->reason,
    //     ];

    //     $refund_response = $this->refundCurl($token, $post_fields);

    //     if (array_key_exists('transactionStatus', $refund_response) && ($refund_response['transactionStatus'] === 'Completed')) {

    //         // IF REFUND PAYMENT SUCCESS THEN YOU CAN APPLY YOUR CONDITION HERE

    //         // THEN YOU CAN REDIRECT TO YOUR ROUTE

    //         return back()->with('successMsg', 'bKash Fund has been Refunded Successfully');
    //     }

    //     return back()->with('error', $refund_response['errorMessage']);
    // }

    // public function refundCurl($token, $post_fields)
    // {
    //     $url = curl_init("$this->base_url/checkout/payment/refund");
    //     $header = array(
    //         'Content-Type:application/json',
    //         'authorization:' . $array["token"],
    //         'x-app-key:' . $array["app_key"]
    //     );

    //     curl_setopt($url, CURLOPT_HTTPHEADER, $header);
    //     curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($post_fields));
    //     curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
    //     $resultdata = curl_exec($url);
    //     curl_close($url);

    //     return json_decode($resultdata, true);
    // }

}