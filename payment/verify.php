<?php
session_start();
ob_start();


$reference = $_GET['reference'];

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_e5069b527554b7b84d2659b98fd5756a9c2492ab",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $response = json_decode($response, true);
    $_SESSION['name'] = $response['data']['metadata']['name'];
    $_SESSION['email'] = $response['data']['customer']['email'];
    $_SESSION['bank'] = $response['data']['authorization']['bank'];
    $_SESSION['card'] = $response['data']['authorization']['bin'].'****'.$response['data']['authorization']['last4'];
    $_SESSION['amount'] = number_format($response['data']['amount']/100, 2, '.', ',');
    $_SESSION['reference'] = $response['data']['reference'];
    $_SESSION['date'] = $response['data']['paid_at'];
    header("Location: /payment/success.php");
    // print_r($response);
  }
?>


