<?php
include '../database/db.php'; // Include your database connection file

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

<section id="testimonials" class="section">
    <h2 class="section-title">Testimonials</h2>
    <div class="container">
        <div class="testimonial-bar">
            <?php
            // Display testimonials from the review table
            foreach ($reviews as $index => $review) {
                $imageIndex = $index % 5 + 1; // Cycle through images 1 to 5
                $imagePath = "../images/review_images/{$imageIndex}.png"; // Construct the image path

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
