<section id="testimonials" class="section">
    <h2 class="section-title">Testimonials</h2>
    <div class="container">
        <div class="testimonial-bar">
            <?php
            // Testimonial data array
            $testimonials = array(
                array(
                    "name" => "John Doe",
                    "image" => "https://media.istockphoto.com/id/1465504312/vector/young-smiling-man-avatar-man-with-brown-beard-mustache-and-hair-wearing-yellow-sweater-or.jpg?s=612x612&w=0&k=20&c=9AyNmOwjadmLC1PKpANKEXj56e1KxHj9h9hGknd-Rb0=",
                    "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet commodo nisi."
                ),
                array(
                    "name" => "Ibrahim Tanvir",
                    "image" => "https://cdn1.iconfinder.com/data/icons/user-pictures/100/male3-512.png",
                    "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet commodo nisi."
                ),
                array(
                    "name" => "Jane Smith",
                    "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7YQbgB9npxBYVFGGwmhyF_CMsubKRE7ruYqXWb5-Qgg&s",
                    "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet commodo nisi."
                ),
                array(
                    "name" => "John Doe",
                    "image" => "https://cdn-icons-png.flaticon.com/512/5556/5556468.png",
                    "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet commodo nisi."
                ),
                array(
                    "name" => "John Doe",
                    "image" => "https://cdn-icons-png.flaticon.com/512/5556/5556495.png",
                    "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet commodo nisi."
                )
            );

            // Display testimonials
            foreach ($testimonials as $testimonial) {
                echo '<div class="testimonial-item">';
                echo '<img src="' . $testimonial["image"] . '" alt="Testimonial Author">';
                echo '<div class="testimonial-info">';
                echo '<h3>' . $testimonial["name"] . '</h3>';
                echo '<p>"' . $testimonial["text"] . '"</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>
