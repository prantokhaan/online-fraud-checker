document.addEventListener("DOMContentLoaded", (event) => {
  let index = 0;
  const testimonials = document.querySelectorAll(".testimonial-item");
  const numVisibleTestimonials = 3; // Number of testimonials visible at a time
  const totalTestimonials = testimonials.length;

  function showTestimonials() {
    for (let i = 0; i < totalTestimonials; i++) {
      if (i >= index && i < index + numVisibleTestimonials) {
        testimonials[i].style.display = "flex";
      } else {
        testimonials[i].style.display = "none";
      }
    }
    index++;
    if (index > totalTestimonials - numVisibleTestimonials) {
      index = 0;
    }
  }

  // Initially show the first set of testimonials
  showTestimonials();

  // Set the interval for sliding
  setInterval(showTestimonials, 3000);
});
