$(document).ready(function() {
    $("#ver_acc_form").on('submit', (function(e) {
      e.preventDefault();
      let bank = $("#bank").val();
      let account_number = $("#account_num").val();
      $.ajax({
        url: `https://api.paystack.co/bank/resolve?account_number=${account_number}&bank_code=${bank}`,
        type: "GET",
        beforeSend: function (xhr) {
            $('#btn_spinner').removeClass('display-none')
            $('#confirm').addClass('display-none')
            xhr.setRequestHeader('Authorization', 'Bearer sk_test_e5069b527554b7b84d2659b98fd5756a9c2492ab');
        },
        data: {},
        success: function(response) {
        //   $("#form").trigger("reset"); // to reset form input fields
            $('#confirm').removeClass('display-none')
            $('#btn_spinner').addClass('display-none')
            $("#account_name").val(response.data.account_name);
        },
        error: function(e) {
            $('#confirm').removeClass('display-none')
            $('#btn_spinner').addClass('display-none')
            alert(e.responseJSON.message);
        }
      });
    }));
  });