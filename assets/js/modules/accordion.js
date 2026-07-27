/* Accordion — single or multi open. a11y: aria-expanded + panel hidden.
   Markup:
   <div class="accordion" data-accordion data-single>
     <div class="accordion-item">
       <button class="accordion-trigger" aria-expanded="false" aria-controls="p1">
         Question <span class="accordion-icon">+</span>
       </button>
       <div class="accordion-panel" id="p1" role="region"><div>
         <div class="accordion-content">Answer</div>
       </div></div>
     </div>
   </div> */
export function initAccordion() {
  document.querySelectorAll("[data-accordion]").forEach((acc) => {
    const single = acc.hasAttribute("data-single");
    const items = acc.querySelectorAll(".accordion-item");

    items.forEach((item) => {
      const trigger = item.querySelector(".accordion-trigger");
      if (!trigger) return;

      trigger.addEventListener("click", () => {
        const willOpen = !item.classList.contains("is-open");
        if (single) {
          items.forEach((i) => {
            i.classList.remove("is-open");
            const t = i.querySelector(".accordion-trigger");
            t && t.setAttribute("aria-expanded", "false");
          });
        }
        item.classList.toggle("is-open", willOpen);
        trigger.setAttribute("aria-expanded", String(willOpen));
      });
    });
  });
}
