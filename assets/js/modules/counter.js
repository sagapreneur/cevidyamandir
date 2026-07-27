/* Counter — animates numbers from 0 to target when scrolled into view.
   Markup: <span class="stat-number" data-count="1500" data-suffix="+">0</span>
   Optional: data-duration (ms), data-decimals */
export function initCounters() {
  const els = document.querySelectorAll("[data-count]");
  if (!els.length) return;

  const run = (el) => {
    const target = parseFloat(el.dataset.count) || 0;
    const duration = parseInt(el.dataset.duration || "1800", 10);
    const decimals = parseInt(el.dataset.decimals || "0", 10);
    const prefix = el.dataset.prefix || "";
    const suffix = el.dataset.suffix || "";
    const start = performance.now();

    const tick = (now) => {
      const p = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3); // easeOutCubic
      const value = (target * eased).toFixed(decimals);
      el.textContent = prefix + Number(value).toLocaleString() + suffix;
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };

  const io = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          run(entry.target);
          obs.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.4 }
  );
  els.forEach((el) => io.observe(el));
}
