<?php
session_start();
if(isset($_SESSION['username'])) {
    echo "<script>localStorage.setItem('username', '" . $_SESSION['username'] . "');</script>";
}
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
    <?php include 'landing_page/testimonial.php'; ?>
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

</body>
</html>
