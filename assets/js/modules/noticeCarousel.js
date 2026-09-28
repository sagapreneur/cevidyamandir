/* Notice carousel — A4 notice images. Prev/next, dots, swipe, keyboard + lightbox.
   Markup: [data-notice-carousel] > .notice-carousel__viewport > .notice-carousel__track > .notice-slide
           arrows .notice-carousel__arrow.prev/.next, dots .notice-carousel__dots
   Lightbox: [data-notice-lightbox] with an <img> and [data-notice-lightbox-close] */
export function initNoticeCarousel() {
  document.querySelectorAll("[data-notice-carousel]").forEach((root) => {
    const track = root.querySelector(".notice-carousel__track");
    const slides = [...root.querySelectorAll(".notice-slide")];
    const dotsWrap = root.querySelector(".notice-carousel__dots");
    if (!track || slides.length === 0) return;

    let index = 0;
    const go = (i) => {
      index = (i + slides.length) % slides.length;
      track.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach((d, di) => d.classList.toggle("is-active", di === index));
    };

    // dots
    const dots = [];
    if (dotsWrap) {
      dotsWrap.innerHTML = "";
      slides.forEach((_, i) => {
        const b = document.createElement("button");
        b.type = "button";
        b.className = "notice-dot" + (i === 0 ? " is-active" : "");
        b.setAttribute("aria-label", `Go to notice ${i + 1}`);
        b.addEventListener("click", () => go(i));
        dotsWrap.appendChild(b);
        dots.push(b);
      });
    }

    root.querySelector(".notice-carousel__arrow.next")?.addEventListener("click", () => go(index + 1));
    root.querySelector(".notice-carousel__arrow.prev")?.addEventListener("click", () => go(index - 1));

    // keyboard
    root.setAttribute("tabindex", "0");
    root.addEventListener("keydown", (e) => {
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

    go(0);
  });

  // Lightbox
  const box = document.querySelector("[data-notice-lightbox]");
  if (box) {
    const img = box.querySelector("img");
    const openZoom = (src) => {
      if (!img || !src) return;
      img.src = src;
      box.classList.add("is-open");
      box.setAttribute("aria-hidden", "false");
      document.body.classList.add("no-scroll");
    };
    const close = () => {
      box.classList.remove("is-open");
      box.setAttribute("aria-hidden", "true");
      document.body.classList.remove("no-scroll");
      if (img) img.src = "";
    };
    document.querySelectorAll("[data-notice-zoom]").forEach((el) => {
      const src = el.getAttribute("data-notice-zoom");
      el.addEventListener("click", () => openZoom(src));
      el.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") { e.preventDefault(); openZoom(src); }
      });
    });
    box.addEventListener("click", (e) => {
      if (e.target === box || e.target.closest("[data-notice-lightbox-close]")) close();
    });
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && box.classList.contains("is-open")) close();
    });
  }
}
