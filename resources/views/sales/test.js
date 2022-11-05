
$(document).ready(function () {
    getAuthToken(); // Replaced function
});

// New function
function getAuthToken() {
    let body = {
      "app_key": app_key,
      "app_secret": app_secret
    };

    $.ajax({
      url: grantTokenUrl,
      headers: {
        "username": username,
        "password": password,
        "Content-Type": "application/json"
      },
      type: 'POST',
      data: JSON.stringify(body),
      success: function (result) {
          
        let headers = {
          "Content-Type": "application/json",
          "Authorization": result.id_token, // Contains access token
          "X-APP-Key": app_key
        };

        let request = {
            "amount": "85.50",
            "intent": "sale",
            "currency": "BDT", // New line
            "merchantInvoiceNumber": "123456" // New line
        };

        initBkash(headers, request);
      },
      error: function (error) {
        // console.log(error);
      }
    });
}

function initBkash(headers, request) {
    bKash.init({
      paymentMode: 'checkout',
      paymentRequest: request, // Updated line

      createRequest: function (request) {
        $.ajax({
          url: createCheckoutUrl,
          headers: headers, // New line
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify(request),
          success: function (data) {
              
            if (data && data.paymentID != null) {
              paymentID = data.paymentID;
              bKash.create().onSuccess(data);
            } 
            else {
              bKash.create().onError(); // Run clean up code
              alert(data.errorMessage + " Tag should be 2 digit, Length should be 2 digit, Value should be number of character mention in Length, ex. MI041234 , supported tags are MI, MW, RF");
            }

          },
          error: function () {
            bKash.create().onError(); // Run clean up code
            alert(data.errorMessage);
          }
        });
      },
      executeRequestOnAuthorization: function () {
        $.ajax({
          url: executeCheckoutUrl + '/' + paymentID, // Updated line
          headers: headers, // New line
          type: 'POST',
          contentType: 'application/json',
          success: function (data) {

            if (data && data.paymentID != null) {
              // On success, perform your desired action
              alert('[SUCCESS] data : ' + JSON.stringify(data));
              window.location.href = "/success_page.html";

            } else {
              alert('[ERROR] data : ' + JSON.stringify(data));
              bKash.execute().onError();//run clean up code
            }

          },
          error: function () {
            alert('An alert has occurred during execute');
            bKash.execute().onError(); // Run clean up code
          }
        });
      },
      onClose: function () {
        alert('User has clicked the close button');
      }
    });

    $('#bKash_button').removeAttr('disabled');

}
