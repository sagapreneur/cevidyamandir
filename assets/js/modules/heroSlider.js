/* Hero slider — fade transitions, autoplay, dots, arrows, keyboard.
   Markup: [data-hero-slider] > .hero-slide (x3) + .hero-dots + arrows */
export function initHeroSlider() {
  const slider = document.querySelector("[data-hero-slider]");
  if (!slider) return;

  const slides = [...slider.querySelectorAll(".hero-slide")];
  if (slides.length < 2) return;

  const dotsWrap = slider.querySelector(".hero-dots");
  const delay = parseInt(slider.dataset.autoplay || "6000", 10);
  let index = 0;
  let timer = null;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // build dots
  const dots = slides.map((_, i) => {
    const b = document.createElement("button");
    b.className = "hero-dot" + (i === 0 ? " is-active" : "");
    b.type = "button";
    b.setAttribute("aria-label", `Go to slide ${i + 1}`);
    b.addEventListener("click", () => go(i, true));
    dotsWrap && dotsWrap.appendChild(b);
    return b;
  });

  function go(i, manual) {
    index = (i + slides.length) % slides.length;
    slides.forEach((s, si) => s.classList.toggle("is-active", si === index));
    dots.forEach((d, di) => d.classList.toggle("is-active", di === index));
    if (manual) restart();
  }
  const next = () => go(index + 1);
  const prev = () => go(index - 1);

  function start() {
    if (reduce || delay <= 0) return;
    timer = setInterval(next, delay);
  }
  function stop() {
    if (timer) clearInterval(timer);
  }
  function restart() {
    stop();
    start();
  }

  slider.querySelector(".hero-arrow.next")?.addEventListener("click", () => go(index + 1, true));
  slider.querySelector(".hero-arrow.prev")?.addEventListener("click", () => go(index - 1, true));
  slider.addEventListener("mouseenter", stop);
  slider.addEventListener("mouseleave", start);

  start();
}
