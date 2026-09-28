/* ============================================================
   EDUTICS — JS entry
   Initializes all interactive modules once DOM is ready.
   ES module. Include with: <script type="module" src="/assets/js/main.js">
   ============================================================ */

import { initStickyHeader } from "./modules/navbar.js";
import { initMobileMenu } from "./modules/mobileMenu.js";
import { initDropdowns } from "./modules/dropdown.js";
import { initAccordion } from "./modules/accordion.js";
import { initTabs } from "./modules/tabs.js";
import { initCounters } from "./modules/counter.js";
import { initScrollReveal } from "./modules/scrollReveal.js";
import { initModals } from "./modules/modal.js";
import { initSmoothScroll } from "./modules/smoothScroll.js";
import { initRipple } from "./modules/ripple.js";
import { initGalleryFilter } from "./modules/galleryFilter.js";
import { initSlider } from "./modules/slider.js";
import { initParallax } from "./modules/parallax.js";
import { initBackToTop } from "./modules/backToTop.js";
import { initHeroSlider } from "./modules/heroSlider.js";
import { initNoticeCarousel } from "./modules/noticeCarousel.js";
import { initCalendarViewer } from "./modules/calendarViewer.js";
import { initDocumentCentre } from "./modules/documentCentre.js";

const boot = () => {
  initStickyHeader();
  initMobileMenu();
  initDropdowns();
  initAccordion();
  initTabs();
  initCounters();
  initScrollReveal();
  initModals();
  initSmoothScroll();
  initRipple();
  initGalleryFilter();
  initSlider();
  initParallax();
  initBackToTop();
  initHeroSlider();
  initNoticeCarousel();
  initCalendarViewer();
  initDocumentCentre();
};

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", boot);
} else {
  boot();
}
