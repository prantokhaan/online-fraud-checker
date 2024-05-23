<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complain Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/customer_complain.css">
    <link rel="stylesheet" href="../css/sidebar.css">

    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the sidebar using PHP -->
    <?php include '../shared/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Complain Form</h2>
            <p class="terms-text">Read our <a href="../terms.php">terms and policy</a> carefully before placing any complaint.</p>
            <form action="process_complain.php" method="post">
                <div class="form-group">
                    <label for="customerName">Seller Name:</label>
                    <input type="text" id="customerName" name="customerName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customerEmail">Seller Email:</label>
                    <input type="email" id="customerEmail" name="customerEmail" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customerPhone">Seller Phone:</label>
                    <input type="tel" id="customerPhone" name="customerPhone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customerAddress">Seller Address:</label>
                    <input type="text" id="customerAddress" name="customerAddress" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customerFacebookId">Seller FB Link/Website Link:</label>
                    <input type="text" id="customerFacebookId" name="customerFacebookId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="courierName">Courier Name:</label>
                    <input type="text" id="courierName" name="courierName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="courierDeliveryId">Courier Delivery ID:</label>
                    <input type="text" id="courierDeliveryId" name="courierDeliveryId" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="orderedProduct">Ordered Product:</label>
                    <input type="text" id="orderedProduct" name="orderedProduct" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="proofImageLink">Image Link of Proofs:</label>
                    <input type="url" id="proofImageLink" name="proofImageLink" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" required>
                        I will be responsible for this complain. <a href="../terms.php">Learn more</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- Your JavaScript files -->
    <script src="script.js"></script>
</body>
</html>
