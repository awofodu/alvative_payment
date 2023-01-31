<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/bank?currency=NGN",
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
    $result = json_decode($response, true);
    // print_r($result['data']);
}
?>


<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Verify Account</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .display-none {
            display: none !important;
        }
    </style>
</head>

<body>

<div class="container">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <form method="POST" id="ver_acc_form">
            <div class="form-group">
                <label for="exampleInputEmail1">Select bank</label>
                <select name="country" class="form-control" id="bank" required>
                    <option value="">-----------------</option>
                    <?php
                    foreach($result['data'] as $value):
                    echo '<option value="'.$value['code'].'">'.$value['name'].'</option>'; //close your tags!!
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Account Number</label>
                <input type="text" required class="form-control" id="account_num" name="email" placeholder="Enter account number">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Account Name</label>
                <input type="text" disabled class="form-control" id="account_name" name="amount" placeholder="Account name displays here">
            </div>
            <button type="submit" class="btn btn-primary" id="confirm">Confirm</button>
            <button type="button" disabled class="btn btn-primary display-none" id="btn_spinner"><span class="spinner"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
</span></button>
            <a href="/" class="btn btn-danger">Home</a>
        </form>
    </div>
    <div class="col-sm-2"></div>
  </div>
</div>

    
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="ajax.js"></script>
</body>
</html>