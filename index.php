<?php
include 'database/db.php';

$query = "SELECT reviewerName, review FROM review";
$result = $conn->query($query);

$reviews = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

$conn->close();
?>

<?php
include 'database/db.php';

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
    <title>Online Fraud Checker</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- CSS  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/hero.css">
    <link rel="stylesheet" href="css/how_it_works.css">
    <link rel="stylesheet" href="css/benefit.css">
    <link rel="stylesheet" href="css/features.css">
    <link rel="stylesheet" href="css/pricing.css">
    <link rel="stylesheet" href="css/testimonial.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- Favicon  -->
    <link rel="icon" href="images/favicon.png">
</head>
<body>
    <?php include 'landing_page/navbar.php'; ?>
    <?php include 'landing_page/hero.php'; ?>
    <?php include 'landing_page/how_it_works.php'; ?>
    <?php include 'landing_page/benefit.php'; ?>
    <?php include 'landing_page/features.php'; ?>
    <?php include 'landing_page/pricing.php'; ?>
    
    <section id="testimonials" class="section">
        <h2 class="section-title">Testimonials</h2>
        <div class="container">
            <div class="testimonial-bar">
                <?php
                // Display testimonials from the review table
                foreach ($reviews as $index => $review) {
                    $imageIndex = $index % 5 + 1; // Cycle through images 1 to 5
                    $imagePath = "images/review_image/{$imageIndex}.png"; // Construct the image path

                    echo '<div class="testimonial-item">';
                    echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Testimonial Author" width="100" height="100">';
                    echo '<div class="testimonial-info">';
                    echo '<h3>' . htmlspecialchars($review["reviewerName"]) . '</h3>';
                    echo '<p>"' . htmlspecialchars($review["review"]) . '"</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <?php include 'landing_page/footer.php'; ?>

    <!-- Modal -->
    <div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this complaint?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript -->
    <script src="js/testimonial.js"></script>
    <script src="js/main.js"></script>
    <script src="js/navbar.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
