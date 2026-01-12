<main class="trad-testimonial-template-two-main">
   <div class="trad-testimonial-template-two-slider">
      <div class="trad-testimonial-template-two-slide-row" id="slide-row">
         <?php foreach ( $settings['testimonials_list'] as $testimonial ) : ?>
         <div class="trad-testimonial-template-two-slide-col">
            <div class="trad-testimonial-template-two-content">
            <p class="trad-testimonial-template-two-content-description"><?php echo esc_html( $testimonial['testimonial_content'] ); ?></p>
            <h2 class="trad-testimonial-template-two-content-heading"><?php echo esc_html( $testimonial['testimonial_name'] ); ?></h2>
            <p class="trad-testimonial-template-two-content-author"><?php echo esc_html( $testimonial['testimonial_location'] ); ?></p>
            </div>
            <div class="trad-testimonial-template-two-hero">
                <?php  
                    $image_url = !empty( $testimonial['testimonial_image']['url'] ) ? $testimonial['testimonial_image']['url'] : esc_url( TRAD_TURBO_ADDONS_PLUGIN_URL . 'assets/images/trad-testimonial.jpg' );
                ?>
               <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $testimonial['testimonial_name'] ); ?>">
            </div>
         </div>
         <?php endforeach; ?>
      </div>
      <div class="trad-testimonial-template-two-indicator">
         <?php for ($i = 0; $i < count($settings['testimonials_list']); $i++) : ?>
            <span class="trad-testimonial-template-two-btn <?php echo esc_attr( $i === 0 ? 'active' : '' ); ?>"></span>
         <?php endfor; ?>
      </div>
   </div>
</main>


<script>
const tradBtns = document.querySelectorAll(".trad-testimonial-template-two-btn");
const tradSlideRow = document.getElementById("slide-row");
const tradMain = document.querySelector(".trad-testimonial-template-two-main");

let tradCurrentIndex = 0;
let tradAutoSlideInterval = <?php echo esc_js($slider_speed); ?>; // Auto slide every 5 seconds

function tradUpdateSlide() {
  const tradMainWidth = tradMain.offsetWidth;
  const tradTranslateValue = tradCurrentIndex * -tradMainWidth;
  tradSlideRow.style.transform = `translateX(${tradTranslateValue}px)`;

  tradBtns.forEach((btn, index) => {
    btn.classList.toggle("active", index === tradCurrentIndex);
  });
}

function tradAutoSlide() {
  tradCurrentIndex = (tradCurrentIndex + 1) % tradBtns.length;
  tradUpdateSlide();
}

// Manual navigation
tradBtns.forEach((btn, index) => {
  btn.addEventListener("click", () => {
    tradCurrentIndex = index;
    tradUpdateSlide();
    clearInterval(tradSlideTimer); // Stop auto sliding when manually navigated
    tradSlideTimer = setInterval(tradAutoSlide, tradAutoSlideInterval); // Restart auto sliding
  });
});

// Update on window resize
window.addEventListener("resize", () => {
  tradUpdateSlide();
});

// Start auto sliding
let tradSlideTimer = setInterval(tradAutoSlide, tradAutoSlideInterval);

</script>
