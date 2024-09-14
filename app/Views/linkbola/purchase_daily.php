<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-xxxxxxxx"></script> <!-- Ganti dengan client key -->
</head>
<body>
    <h3>Redirecting to payment...</h3>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var snapToken = '<?= $snapToken ?>';
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    // Redirect user to another page upon successful payment
                    window.location.href = '/linkbola/payment-success-daily';
                },
                onPending: function(result) {
                    // Redirect user to another page if payment is pending
                    window.location.href = '/linkbola/payment_pending';
                },
                onError: function(result) {
                    // Redirect user to another page if payment failed
                    window.location.href = '/linkbola/payment_error';
                }
            });
        });
    </script>
</body>
</html>
