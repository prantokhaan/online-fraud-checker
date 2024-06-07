<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking</title>
    <link rel="stylesheet" href="courierNavbar.css">
    <link rel="stylesheet" href="courier.css">

</head>
<body onload="setCourierName()">
    <?php include 'courierNavbar.php'; ?>
    <div class="home-section">
        <div class="container">
        <h1>Add Booking</h1>
        <form action="process_form.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="courier-name" id="courier-name">
            <div class="form-group">
                <label for="customer-name">Customer Name:</label>
                <input type="text" name="customer-name" id="customer-name" required>
            </div>
            <div class="form-group">
                <label for="phone-number">Phone Number:</label>
                <input type="text" name="phone-number" id="phone-number" required>
            </div>
            <div class="form-group">
                <label for="seller-name">Seller Name:</label>
                <input type="text" name="seller-name" id="seller-name" required>
            </div>
            <div class="form-group">
                <label for="seller-phone">Seller Phone:</label>
                <input type="text" name="seller-phone" id="seller-phone" required>
            </div>
            <div class="form-group">
                <label for="courier-booking-id">Courier Booking ID:</label>
                <input type="text" name="courier-booking-id" id="courier-booking-id" required>
            </div>
            <div class="form-group">
                <label for="ordered-product">Ordered Product:</label>
                <input type="text" name="ordered-product" id="ordered-product" required>
            </div>
            
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    </div>

    <script>
        var courierName = localStorage.getItem('courier');
        document.getElementById('courier-name').value = courierName;
        console.log('Courier Name:', courierName);
    </script>

    <script src="./main.js"></script>
</body>
</html>
