/* Document Centre — instant search + category pill filtering.
   Cards: [data-doc] with data-title, data-cat, data-keywords
   Filters: [data-doc-filters] > [data-doc-filter="<cat|all>"]
   Search: [data-doc-search]  •  Category sections: .doc-cat[data-cat]
   Empty state: [data-doc-empty] */
export function initDocumentCentre() {
  const root = document.querySelector("[data-doc-search], [data-doc-filters]");
  if (!root) return;

  const searchInput = document.querySelector("[data-doc-search]");
  const pills = [...document.querySelectorAll("[data-doc-filter]")];
  const cards = [...document.querySelectorAll("[data-doc]")];
  const cats = [...document.querySelectorAll(".doc-cat")];
  const subgroups = [...document.querySelectorAll(".doc-subgroup")];
  const emptyEl = document.querySelector("[data-doc-empty]");
  if (cards.length === 0) return;

  let activeCat = "all";
  let query = "";

  const apply = () => {
    let anyVisible = false;

    cards.forEach((card) => {
      const matchCat = activeCat === "all" || card.dataset.cat === activeCat;
      const haystack = (card.dataset.title || "") + " " + (card.dataset.cat || "") + " " + (card.dataset.keywords || "");
      const matchText = query === "" || haystack.indexOf(query) !== -1;
      const show = matchCat && matchText;
      card.hidden = !show;
      if (show) anyVisible = true;
    });

    // hide empty subgroups
    subgroups.forEach((sg) => {
      const visible = sg.querySelectorAll("[data-doc]:not([hidden])").length > 0;
      sg.hidden = !visible;
    });

    // hide empty category sections
    cats.forEach((cat) => {
      const visible = cat.querySelectorAll("[data-doc]:not([hidden])").length > 0;
      cat.hidden = !visible;
    });

    if (emptyEl) emptyEl.hidden = anyVisible;
  };

  if (searchInput) {
    searchInput.addEventListener("input", () => {
      query = searchInput.value.trim().toLowerCase();
      apply();
    });
  }

  pills.forEach((pill) => {
    pill.addEventListener("click", () => {
      pills.forEach((p) => p.classList.remove("is-active"));
      pill.classList.add("is-active");
      activeCat = pill.dataset.docFilter || "all";
      apply();
    });
  });
}
