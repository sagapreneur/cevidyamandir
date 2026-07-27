/* Sticky header — toggles `.is-stuck` after scroll threshold. */
export function initStickyHeader(selector = ".site-header", threshold = 24) {
  const header = document.querySelector(selector);
  if (!header) return;

  let ticking = false;
  const update = () => {
    header.classList.toggle("is-stuck", window.scrollY > threshold);
    ticking = false;
  };

  window.addEventListener(
    "scroll",
    () => {
      if (!ticking) {
        window.requestAnimationFrame(update);
        ticking = true;
      }
    },
    { passive: true }
  );
  update();
}
