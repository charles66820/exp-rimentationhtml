var express = require('express');
var request = require('request');
const fs = require('fs');

// Add your credentials:
// Add your client ID and secret
var CLIENT = 'AThYz7WIB6vDImiRWSbwtCgzm23HXWvMVSsUac8hv-sqCgePc020mo8kZ3ev7YnhrMIpQCBz56wheud7';
var SECRET = 'EEINqSzenCi6nLsDDhR1iPjKtL4eRF30EMB1qkYyIyzFKy2qGMymWTFt85yBIA5rYsgCWJ82KIX0iprE';

var PAYPAL_API = 'https://api.sandbox.paypal.com';

express()
  .get('/', (req, res) => {
    fs.readFile('./toto.html', (err, data) => {
      res.writeHead(200, {'Content-Type': 'text/html'});
      res.write(data);
      res.end();
    })
  })

  // Set up the payment:
  // 1. Set up a URL to handle requests from the PayPal button
  .post('/my-api/create-payment/', function(req, res) {
    // 2. Call /v1/payments/payment to set up the payment
    request.post(PAYPAL_API + '/v1/payments/payment', {
      auth: {
        user: CLIENT,
        pass: SECRET
      },
      body: {
        intent: 'sale',
        payer: {
          payment_method: 'paypal'
        },
        transactions: [{
          amount: {
            total: '10.99',
            currency: 'EUR'
          }
        }],
        redirect_urls: {
          return_url: 'https://www.mysite.com',
          cancel_url: 'https://www.mysite.com'
        }
      },
      json: true
    }, function (err, response) {
        if (err) {
          console.error(err);
          return res.sendStatus(500);
        }

        // 3. Return the payment ID to the client
        res.json({
          id: response.body.id
        });
    });
  })

  // Execute the payment:
  // 1. Set up a URL to handle requests from the PayPal button.
  .post('/my-api/execute-payment/', function(req, res) {
    var POST = {};
    req.on('data', function (data) {
      data = data.toString();
      data = data.split('&');
      for (var i = 0; i < data.length; i++) {
        var onedata = data[i].split("=");
        POST[onedata[0]] = onedata[1];
      }

      // 2. Get the payment ID and the payer ID from the request body.
      var paymentID = POST["paymentID"];
      var payerID   = POST["payerID"];

      // 3. Call /v1/payments/payment/PAY-XXX/execute to finalize the payment.
      request.post(PAYPAL_API + '/v1/payments/payment/' + paymentID + '/execute', {
        auth: {
          user: CLIENT,
          pass: SECRET
        },
        body: {
          payer_id: payerID,
          transactions: [{
            amount: {
              total: '10.99',
              currency: 'EUR'
            }
          }]
        },
        json: true
      }, function (err, response) {
        if (err) {
          console.error(err);
          return res.sendStatus(500);
        }

        // 4. Return a success response to the client
        res.json({
          status: 'success'
        });
      });
    })

  })
  .listen(3000, function() {
    console.log('Server listening at http://localhost:3000/');
  });

  // Run `node ./server.js` in your terminal
