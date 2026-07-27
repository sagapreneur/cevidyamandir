/* Modal / popup / video lightbox.
   Open:  <button data-modal-open="#myModal">
   Close: <button data-modal-close> or click backdrop / ESC
   Video: data-modal-open="#video" data-video="https://youtube.com/embed/ID" */
export function initModals() {
  const openers = document.querySelectorAll("[data-modal-open]");
  let lastFocused = null;

  const open = (backdrop, videoUrl) => {
    lastFocused = document.activeElement;
    backdrop.classList.add("is-open");
    document.body.classList.add("no-scroll");
    if (videoUrl) {
      const frame = backdrop.querySelector("iframe");
      if (frame) frame.src = videoUrl + "?autoplay=1";
    }
    const focusable = backdrop.querySelector(
      "button, a, input, textarea, select"
    );
    focusable && focusable.focus();
    document.addEventListener("keydown", onKey);
  };

  const close = (backdrop) => {
    backdrop.classList.remove("is-open");
    document.body.classList.remove("no-scroll");
    const frame = backdrop.querySelector("iframe");
    if (frame) frame.src = "";
    document.removeEventListener("keydown", onKey);
    lastFocused && lastFocused.focus();
  };

  const onKey = (e) => {
    if (e.key === "Escape") {
      document
        .querySelectorAll(".modal-backdrop.is-open")
        .forEach((b) => close(b));
    }
  };

  openers.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const target = document.querySelector(btn.dataset.modalOpen);
      if (target) open(target, btn.dataset.video);
    });
  });

  document.querySelectorAll(".modal-backdrop").forEach((backdrop) => {
    backdrop.addEventListener("click", (e) => {
      if (e.target === backdrop || e.target.closest("[data-modal-close]")) {
        close(backdrop);
      }
    });
  });
}
