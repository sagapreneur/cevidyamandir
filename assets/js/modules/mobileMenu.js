/* Mobile drawer — open/close with backdrop, ESC, focus trap, scroll lock.
   Markup:
   <button data-menu-open aria-controls="mobileDrawer" aria-expanded="false">
   <div class="mobile-backdrop" data-menu-close></div>
   <aside id="mobileDrawer" class="mobile-drawer"> ... <button data-menu-close> */
export function initMobileMenu() {
  const openBtn = document.querySelector("[data-menu-open]");
  const drawer = document.querySelector(".mobile-drawer");
  const backdrop = document.querySelector(".mobile-backdrop");
  if (!openBtn || !drawer) return;

  const closeEls = document.querySelectorAll("[data-menu-close]");

  const open = () => {
    drawer.classList.add("is-open");
    backdrop && backdrop.classList.add("is-open");
    openBtn.setAttribute("aria-expanded", "true");
    document.body.classList.add("no-scroll");
    const first = drawer.querySelector("a, button");
    first && first.focus();
    document.addEventListener("keydown", onKey);
  };

  const close = () => {
    drawer.classList.remove("is-open");
    backdrop && backdrop.classList.remove("is-open");
    openBtn.setAttribute("aria-expanded", "false");
    document.body.classList.remove("no-scroll");
    openBtn.focus();
    document.removeEventListener("keydown", onKey);
  };

  const onKey = (e) => {
    if (e.key === "Escape") close();
  };

  openBtn.addEventListener("click", open);
  closeEls.forEach((el) => el.addEventListener("click", close));
  // close after tapping a nav link
  drawer.querySelectorAll("a").forEach((a) =>
    a.addEventListener("click", () => window.innerWidth < 1024 && close())
  );
}
