/* Scroll reveal — toggles `.is-visible` on `[data-reveal]` when in view.
   Respects prefers-reduced-motion. Optional data-reveal-delay (ms) or
   data-reveal-stagger on a parent to cascade children. */
export function initScrollReveal() {
  const els = document.querySelectorAll("[data-reveal]");
  if (!els.length) return;

  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (reduce) {
    els.forEach((el) => el.classList.add("is-visible"));
    return;
  }

  // apply stagger delays
  document.querySelectorAll("[data-reveal-stagger]").forEach((parent) => {
    const step = parseInt(parent.dataset.revealStagger || "90", 10);
    parent.querySelectorAll("[data-reveal]").forEach((child, i) => {
      child.style.setProperty("--delay", `${i * step}ms`);
    });
  });

  const io = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const delay = entry.target.dataset.revealDelay;
          if (delay) entry.target.style.setProperty("--delay", `${delay}ms`);
          entry.target.classList.add("is-visible");
          obs.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15, rootMargin: "0px 0px -8% 0px" }
  );
  els.forEach((el) => io.observe(el));
}
