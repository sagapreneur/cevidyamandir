/* Dropdown — hover on desktop (CSS), click/keyboard toggle for touch & a11y.
   Markup: <li class="nav-item"><button class="nav-link" aria-expanded="false"
            aria-haspopup="true">...</button><div class="nav-dropdown">...</div></li> */
export function initDropdowns() {
  const items = document.querySelectorAll(".nav-item");
  items.forEach((item) => {
    const trigger = item.querySelector(".nav-link");
    const menu = item.querySelector(".nav-dropdown");
    if (!trigger || !menu) return;

    trigger.setAttribute("aria-haspopup", "true");
    trigger.setAttribute("aria-expanded", "false");

    trigger.addEventListener("click", (e) => {
      // Only intercept when it's a menu toggle (no real href navigation)
      if (trigger.tagName === "BUTTON" || trigger.getAttribute("href") === "#") {
        e.preventDefault();
        const open = item.classList.toggle("is-open");
        trigger.setAttribute("aria-expanded", String(open));
      }
    });

    item.addEventListener("focusout", (e) => {
      if (!item.contains(e.relatedTarget)) {
        item.classList.remove("is-open");
        trigger.setAttribute("aria-expanded", "false");
      }
    });
  });
}
