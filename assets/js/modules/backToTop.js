/* Back-to-top — reveals after scrolling, smooth-scrolls to top. */
export function initBackToTop() {
  const btn = document.querySelector("[data-back-to-top]");
  if (!btn) return;

  let ticking = false;
  const update = () => {
    btn.classList.toggle("is-visible", window.scrollY > 500);
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
  btn.addEventListener("click", () =>
    window.scrollTo({ top: 0, behavior: "smooth" })
  );
  update();
}
