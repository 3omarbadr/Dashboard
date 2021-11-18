<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

    private $base_url;
    private $request_client;
    private $token;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('MYFATOORAH_BASE_URL');
        $this->token = env('MYFATOORAH_TOKEN');
    }

    public function getPayments($amount)
    {
        return view('products.payments', compact('amount'));
    }

    public function processPayment()
    {
        /* ------------------------ Configurations ---------------------------------- */
        //Test
        $apiURL = $this->base_url;
        $apiKey = $this->token; //Test token value to be placed here: https://myfatoorah.readme.io/docs/test-token

        //Live
        //$apiURL = 'https://api.myfatoorah.com';
        //$apiKey = ''; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


        /* ------------------------ Call InitiatePayment Endpoint ------------------- */
        //Fill POST fields array
        $ipPostFields = ['InvoiceAmount' => 100, 'CurrencyIso' => 'KWD'];

        //Call endpoint
        $paymentMethods = $this->initiatePayment($apiURL, $apiKey, $ipPostFields);

        //You can save $paymentMethods information in database to be used later
        $paymentMethodId = 2;
        /*foreach ($paymentMethods as $pm) {
    if ($pm->PaymentMethodEn == 'VISA/MASTER') {
        $paymentMethodId = $pm->PaymentMethodId;
        break;
    }
}*/

        /* ------------------------ Call ExecutePayment Endpoint -------------------- */
        //Fill customer address array
        /* $customerAddress = array(
  'Block'               => 'Blk #', //optional
  'Street'              => 'Str', //optional
  'HouseBuildingNo'     => 'Bldng #', //optional
  'Address'             => 'Addr', //optional
  'AddressInstructions' => 'More Address Instructions', //optional
  ); */

        //Fill invoice item array
        /* $invoiceItems[] = [
  'ItemName'  => 'Item Name', //ISBAN, or SKU
  'Quantity'  => '2', //Item's quantity
  'UnitPrice' => '25', //Price per item
  ]; */

        //Fill POST fields array
        $postFields = [
            //Fill required data
            'paymentMethodId' => $paymentMethodId,
            'InvoiceValue'    => '50',
            'CallBackUrl'     => 'http://127.0.0.1:8000/response',
            'ErrorUrl'        => 'https://example.com/callback.php', //or 'https://example.com/error.php'    
            //Fill optional data
            //'CustomerName'       => 'fname lname',
            //'DisplayCurrencyIso' => 'KWD',
            //'MobileCountryCode'  => '+965',
            //'CustomerMobile'     => '1234567890',
            //'CustomerEmail'      => 'email@example.com',
            //'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
        ];

        //Call endpoint
        $data = $this->executePayment($apiURL, $apiKey, $postFields);

        //You can save payment data in database as per your needs
        $invoiceId   = $data->InvoiceId;
        $paymentLink = $data->PaymentURL;

       

        return redirect($paymentLink);

    }


    public function getPaymentStatus($paymentId)
    {
         /* ------------------------ Configurations ---------------------------------- */
        //Test
        $apiURL = $this->base_url."/v2/getPaymentStatus";
        $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';

        //Live
        //$apiURL = 'https://api.myfatoorah.com';
        //$apiKey = ''; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


        /* ------------------------ Call getPaymentStatus Endpoint ------------------ */
        //Inquiry using paymentId
        $keyId   = $paymentId;
        $KeyType = 'paymentId';

        //Inquiry using invoiceId 
        /*$keyId   = '613842';
$KeyType = 'invoiceId';*/

        //Fill POST fields array
        $postFields = [
            'Key'     => $keyId,
            'KeyType' => $KeyType
        ];
        //Call endpoint
        $json       = $this->callAPI($apiURL, $apiKey, $postFields);

        // dd($json->Data);
        //Display the payment result to your customer
        echo '<div class = "alert alert-success">'.'Payment status is '. $json->Data->InvoiceStatus.'</div>';

        //Redirect your customer to the payment page to complete the payment process
        //Display the payment link to your customer
        // echo "Click on <a href='$paymentLink' target='_blank'>$paymentLink</a> to pay with invoiceID $invoiceId.";
        // die;
    }

    /* ------------------------ Functions --------------------------------------- */
    /*
 * Initiate Payment Endpoint Function 
 */

    public function initiatePayment($apiURL, $apiKey, $postFields)
    {

        $json = $this->callAPI("$apiURL/v2/InitiatePayment", $apiKey, $postFields);
        return $json->Data->PaymentMethods;
    }

    //------------------------------------------------------------------------------
    /*
 * Execute Payment Endpoint Function 
 */

    public function executePayment($apiURL, $apiKey, $postFields)
    {

        $json = $this->callAPI("$apiURL/v2/ExecutePayment", $apiKey, $postFields);
        return $json->Data;
    }

    //------------------------------------------------------------------------------
    /*
 * Call API Endpoint Function
 */

    public function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {

        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => $requestType,
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);
        if ($error) {
            die("Error: $error");
        }

        return json_decode($response);
    }

    //------------------------------------------------------------------------------
    /*
 * Handle Endpoint Errors Function 
 */

    public function handleError($response)
    {

        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }





}
