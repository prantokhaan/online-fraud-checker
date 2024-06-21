<?php
include '../database/db.php';

// Fetch all pricing plans from the database
$query = "SELECT * FROM pricing";
$result = $conn->query($query);

$plans = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $plans[] = $row;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="icon" href="../images/favicon.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            margin-top: 20px;
            padding: 0;
            box-sizing: border-box;
        }
        .section {
            padding: 2rem 0;
            text-align: center;
        }
        .section-title {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .col-md-4 {
            width: 30%;
            margin-bottom: 1.5rem;
        }
        .plan {
            background: #f8f8f8;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .plan h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .plan .price {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .plan ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .plan ul li {
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <?php include '../landing_page/navbar.php'; ?>

    <section id="pricing" class="section">
        <h2 class="section-title">Pricing & Plans</h2>
        <div class="container">
            <div class="row">
                <?php foreach ($plans as $plan): ?>
                    <div class="col-md-4">
                        <div class="plan">
                            <h3><?php echo htmlspecialchars($plan['packageName']); ?></h3>
                            <p class="price">$<?php echo htmlspecialchars($plan['price']); ?>/month</p>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Feature 1</li>
                                <li><i class="fas fa-check-circle"></i> Feature 2</li>
                                <li><i class="fas fa-times-circle"></i> Feature 3</li>
                            </ul>
                            <button onclick="subscribe('<?php echo htmlspecialchars($plan['packageName']); ?>')" class="btn">Grab Now</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <script src="../js/navbar.js"></script>
    <script src="../js/subscribe.js"></script>
    <script src="../js/userAuth.js"></script>
</body>
</html>
