/* Smooth scroll for in-page anchor links, offset by header height. */
export function initSmoothScroll() {
  const headerH =
    parseInt(
      getComputedStyle(document.documentElement).getPropertyValue(
        "--header-height"
      )
    ) || 88;

  document.querySelectorAll('a[href^="#"]').forEach((link) => {
    const id = link.getAttribute("href");
    if (id === "#" || id.length < 2) return;

    link.addEventListener("click", (e) => {
      const target = document.querySelector(id);
      if (!target) return;
      e.preventDefault();
      const top =
        target.getBoundingClientRect().top + window.scrollY - headerH - 16;
      window.scrollTo({ top, behavior: "smooth" });
      history.pushState(null, "", id);
    });
  });
}
