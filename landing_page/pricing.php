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
                            <li><i class="fas fa-check-circle"></i> Feature 3</li>
                        </ul>
                        <a href="../Subscribe/subscribe.php" class="btn">Grab Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>