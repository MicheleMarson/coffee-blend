<?php include("../includes/header.php") ?>
<?php

//dont allow user to go to checkout if there is no products inside
if (!isset($_SERVER["HTTP_REFERER"])) {
    //redirect them to desired location
    header("location: http://localhost/coffee-blend/index.php");
    exit;
}
?>


<?php
$heroVar = (object)["title" => "Pay with PayPal"];
include("../includes/hero.php");
?>

<div class="container my-5">
    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=ARr2txEIDtod5cUcZ_rhCckntYHM5Oiu1tecOKvDoev_gfCSIvgdv3jaK3pVVzl1dzDwQdxgmkQbkrcR&currency=USD"></script>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $_SESSION["totalPrice"] ?>' // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {

                    window.location.href = 'delete-cart.php';
                });
            }
        }).render('#paypal-button-container');
    </script>

</div>
<?php include("../includes/footer.php") ?>