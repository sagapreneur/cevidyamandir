/* Lightweight slider — testimonials/logos. Autoplay + dots + swipe.
   Markup:
   <div class="slider" data-slider data-autoplay="5000">
     <div class="slider-track">
       <div class="slider-slide">...</div>
     </div>
     <div class="slider-dots"></div>
   </div> */
export function initSlider() {
  document.querySelectorAll("[data-slider]").forEach((slider) => {
    const track = slider.querySelector(".slider-track");
    const slides = [...slider.querySelectorAll(".slider-slide")];
    const dotsWrap = slider.querySelector(".slider-dots");
    if (!track || slides.length < 2) return;

    let index = 0;
    const autoplay = parseInt(slider.dataset.autoplay || "0", 10);
    let timer = null;

    slides.forEach((s) => (s.style.flex = "0 0 100%"));

    // dots
    const dots = [];
    if (dotsWrap) {
      slides.forEach((_, i) => {
        const dot = document.createElement("button");
        dot.className = "slider-dot" + (i === 0 ? " is-active" : "");
        dot.setAttribute("aria-label", `Go to slide ${i + 1}`);
        dot.addEventListener("click", () => go(i));
        dotsWrap.appendChild(dot);
        dots.push(dot);
      });
    }

    const go = (i) => {
      index = (i + slides.length) % slides.length;
      track.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach((d, di) => d.classList.toggle("is-active", di === index));
    };
    const next = () => go(index + 1);

    // autoplay
    const start = () => autoplay && (timer = setInterval(next, autoplay));
    const stop = () => timer && clearInterval(timer);
    slider.addEventListener("mouseenter", stop);
    slider.addEventListener("mouseleave", start);

    // swipe
    let x0 = null;
    track.addEventListener("pointerdown", (e) => (x0 = e.clientX));
    track.addEventListener("pointerup", (e) => {
      if (x0 === null) return;
      const dx = e.clientX - x0;
      if (Math.abs(dx) > 40) go(index + (dx < 0 ? 1 : -1));
      x0 = null;
    });

    start();
  });
}
