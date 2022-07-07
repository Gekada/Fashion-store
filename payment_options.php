<div class="box">

	<?php

	$session_email = $_SESSION['customer_email'];

	$select_customer = "Select * from customers where customer_email = '$session_email'";

	$run_customer = mysqli_query($connection, $select_customer);

	$row_customer = mysqli_fetch_array($run_customer);

	$customer_id = $row_customer['customer_id'];

	//$total = totalPrice();



	?>

	<h1 class="text-center">
		Available Payment Options
	</h1>

	<p class="lead text-center">
		<a id="offline-payment" href="order.php?c_id=<?php echo $customer_id ?>">Offline Payment</a>
	</p>
	<center>
		 <div id="paypal-button-container"></div>
        <!-- Sample PayPal credentials (client-id) are included -->
        <script src="https://www.paypal.com/sdk/js?client-id=Ad4cswRPneGATQ551H7JXfjfHomX-6DtGowZvrOKM_sjU4XZQy4OtnfgltQZyl8cQ2W2Lx1gt4ySVDhz"></script>
        <script>
          const paypalButtonsComponent = paypal.Buttons({
              // optional styling for buttons
              // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
              style: {
                color: "gold",
                shape: "rect",
                layout: "vertical"
              },

              // set up the transaction
              createOrder: (data, actions) => {
                  // pass in any options from the v2 orders create call:
                  // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                  const createOrderPayload = {
                      purchase_units: [
                          {
                              amount: {
                                  value: <?php totalPrice() ?>
                              }
                          }
                      ]
                  };

                  return actions.order.create(createOrderPayload);
              },

              // finalize the transaction
              onApprove: (data, actions) => {
                  const captureOrderHandler = (details) => {
                      const payerName = details.payer.name.given_name;
                  		window.open('order.php?c_id=<?php echo $customer_id ?>', '_self')
                      //alert('Transaction completed');
                  };

                  return actions.order.capture().then(captureOrderHandler);
              },

              // handle unrecoverable errors
              onError: (err) => {
                  alert('An error prevented the buyer from checking out with PayPal');
              }
          });

          paypalButtonsComponent
              .render("#paypal-button-container")
              .catch((err) => {
                  console.error('PayPal Buttons failed to render');
              });
        </script>
	</center>
</div>