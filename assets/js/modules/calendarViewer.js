/* Academic calendar viewer — A4 landscape carousel + full-screen lightbox.
   Carousel: [data-cal-viewer] > [data-cal-track] > [data-cal-slide]
   Controls: [data-cal-prev] [data-cal-next] (may appear multiple times),
             [data-cal-current] counter, [data-cal-title] indicator, [data-cal-dots]
   Lightbox: [data-cal-lightbox] with [data-cal-lightbox-img], [data-cal-lightbox-close] */
export function initCalendarViewer() {
  const viewer = document.querySelector("[data-cal-viewer]");
  if (!viewer) return;

  const track = viewer.querySelector("[data-cal-track]");
  const slides = [...viewer.querySelectorAll("[data-cal-slide]")];
  if (!track || slides.length === 0) return;

  const dotsWrap = viewer.querySelector("[data-cal-dots]");
  const titleEl = viewer.querySelector("[data-cal-title]");
  const currentEl = viewer.querySelector("[data-cal-current]");
  const box = document.querySelector("[data-cal-lightbox]");
  const boxImg = box ? box.querySelector("[data-cal-lightbox-img]") : null;

  let index = 0;
  const pad = (n) => String(n).padStart(2, "0");

  // dots
  const dots = [];
  if (dotsWrap) {
    slides.forEach((_, i) => {
      const b = document.createElement("button");
      b.type = "button";
      b.className = "cal-dot" + (i === 0 ? " is-active" : "");
      b.setAttribute("aria-label", `Go to calendar page ${i + 1}`);
      b.addEventListener("click", () => go(i));
      dotsWrap.appendChild(b);
      dots.push(b);
    });
  }

  function go(i) {
    index = (i + slides.length) % slides.length;
    track.style.transform = `translateX(-${index * 100}%)`;
    dots.forEach((d, di) => d.classList.toggle("is-active", di === index));
    if (titleEl) titleEl.textContent = slides[index].dataset.title || `Page ${index + 1}`;
    if (currentEl) currentEl.textContent = pad(index + 1);
    if (box && box.classList.contains("is-open") && boxImg) {
      boxImg.src = slides[index].dataset.src || "";
    }
  }

  // prev/next (all such buttons on the page share navigation)
  document.querySelectorAll("[data-cal-next]").forEach((b) => b.addEventListener("click", () => go(index + 1)));
  document.querySelectorAll("[data-cal-prev]").forEach((b) => b.addEventListener("click", () => go(index - 1)));

  // keyboard
  viewer.setAttribute("tabindex", "0");
  viewer.addEventListener("keydown", (e) => {
    if (e.key === "ArrowRight") go(index + 1);
    if (e.key === "ArrowLeft") go(index - 1);
  });

  // swipe
  let x0 = null;
  track.addEventListener("pointerdown", (e) => (x0 = e.clientX));
  track.addEventListener("pointerup", (e) => {
    if (x0 === null) return;
    const dx = e.clientX - x0;
    if (Math.abs(dx) > 40) go(index + (dx < 0 ? 1 : -1));
    x0 = null;
  });

  // lightbox
  if (box && boxImg) {
    const open = () => {
      const src = slides[index].dataset.src;
      if (!src) return;
      boxImg.src = src;
      boxImg.classList.remove("is-zoomed");
      box.classList.add("is-open");
      box.setAttribute("aria-hidden", "false");
      document.body.classList.add("no-scroll");
    };
    const close = () => {
      box.classList.remove("is-open");
      box.setAttribute("aria-hidden", "true");
      document.body.classList.remove("no-scroll");
      boxImg.src = "";
    };
    viewer.querySelectorAll("[data-cal-zoom]").forEach((el) => {
      el.addEventListener("click", open);
      el.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") { e.preventDefault(); open(); }
      });
    });
    boxImg.addEventListener("click", (e) => { e.stopPropagation(); boxImg.classList.toggle("is-zoomed"); });
    box.addEventListener("click", (e) => {
      if (e.target === box || e.target.closest("[data-cal-lightbox-close]")) close();
    });
    document.addEventListener("keydown", (e) => {
      if (!box.classList.contains("is-open")) return;
      if (e.key === "Escape") close();
      if (e.key === "ArrowRight") go(index + 1);
      if (e.key === "ArrowLeft") go(index - 1);
    });
  }

  go(0);
}
