<?php
  if(isset($_POST['pay'])){
    $url = "https://api.paystack.co/transaction/initialize";

    $fields = [
        'email' => $_POST['email'],
        'amount' => $_POST['amount']."00",
        'metadata' => [
            "name" => $_POST['name']
        ],
    ];

    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();
    
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer sk_test_e5069b527554b7b84d2659b98fd5756a9c2492ab",
        "Cache-Control: no-cache",
    ));
    
    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    
    //execute post
    $r_json = curl_exec($ch);
    $result = json_decode($r_json, true);
    $url = $result['data']['authorization_url'];
    //   print_r();
    header("Location: $url");
  }
?>