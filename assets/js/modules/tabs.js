/* Tabs — ARIA tablist with arrow-key navigation.
   Markup:
   <div class="tabs" data-tabs>
     <div class="tablist" role="tablist">
       <button class="tab" role="tab" aria-selected="true" aria-controls="t1" id="tab1">One</button>
     </div>
     <div class="tabpanel is-active" role="tabpanel" id="t1" aria-labelledby="tab1">...</div>
   </div> */
export function initTabs() {
  document.querySelectorAll("[data-tabs]").forEach((group) => {
    const tabs = [...group.querySelectorAll('[role="tab"]')];
    const panels = [...group.querySelectorAll('[role="tabpanel"]')];
    if (!tabs.length) return;

    const activate = (idx) => {
      tabs.forEach((t, i) => {
        const selected = i === idx;
        t.setAttribute("aria-selected", String(selected));
        t.tabIndex = selected ? 0 : -1;
        panels[i] && panels[i].classList.toggle("is-active", selected);
      });
      tabs[idx].focus();
    };

    tabs.forEach((tab, i) => {
      tab.addEventListener("click", () => activate(i));
      tab.addEventListener("keydown", (e) => {
        if (e.key === "ArrowRight" || e.key === "ArrowDown") {
          e.preventDefault();
          activate((i + 1) % tabs.length);
        } else if (e.key === "ArrowLeft" || e.key === "ArrowUp") {
          e.preventDefault();
          activate((i - 1 + tabs.length) % tabs.length);
        } else if (e.key === "Home") {
          e.preventDefault();
          activate(0);
        } else if (e.key === "End") {
          e.preventDefault();
          activate(tabs.length - 1);
        }
      });
    });
  });
}
