/* Gallery filter — filter chips toggle visibility of grid items by category.
   Markup:
   <div class="gallery-filters" data-gallery-filters>
     <button class="chip is-active" data-filter="all">All</button>
     <button class="chip" data-filter="events">Events</button>
   </div>
   <div class="gallery-grid" data-gallery>
     <figure class="gallery-item" data-category="events">...</figure>
   </div> */
export function initGalleryFilter() {
  const filterBars = document.querySelectorAll("[data-gallery-filters]");
  filterBars.forEach((bar) => {
    const grid = document.querySelector("[data-gallery]");
    if (!grid) return;
    const items = grid.querySelectorAll(".gallery-item");

    bar.addEventListener("click", (e) => {
      const chip = e.target.closest("[data-filter]");
      if (!chip) return;
      bar
        .querySelectorAll("[data-filter]")
        .forEach((c) => c.classList.remove("is-active"));
      chip.classList.add("is-active");

      const filter = chip.dataset.filter;
      items.forEach((item) => {
        const show = filter === "all" || item.dataset.category === filter;
        item.classList.toggle("is-hidden", !show);
      });
    });
  });
}
