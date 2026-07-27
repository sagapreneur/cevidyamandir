/* Parallax — subtle translate on `[data-parallax]` (speed via data-speed).
   Disabled under prefers-reduced-motion. Premium = gentle (speed 0.1–0.25). */
export function initParallax() {
  const els = document.querySelectorAll("[data-parallax]");
  if (!els.length) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  let ticking = false;
  const update = () => {
    const vh = window.innerHeight;
    els.forEach((el) => {
      const speed = parseFloat(el.dataset.speed || "0.15");
      const rect = el.getBoundingClientRect();
      const offset = (rect.top + rect.height / 2 - vh / 2) * -speed;
      el.style.setProperty("--py", `${offset.toFixed(1)}px`);
    });
    ticking = false;
  };

  window.addEventListener(
    "scroll",
    () => {
      if (!ticking) {
        requestAnimationFrame(update);
        ticking = true;
      }
    },
    { passive: true }
  );
  update();
}
