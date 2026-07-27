/* ============================================================
   Public form handler — progressive enhancement.
   Serialises any site form and posts it to the CMS /submit
   endpoint (stored in form_submissions). No markup changes.
   ============================================================ */
(function () {
  var csrf = (document.querySelector('meta[name="csrf"]') || {}).content || "";
  var pageType = document.body.getAttribute("data-page") || "contact";

  function message(form, ok, text) {
    var box = form.querySelector(".form-message");
    if (!box) {
      box = document.createElement("div");
      box.className = "form-message";
      box.style.marginTop = "14px";
      box.style.padding = "12px 16px";
      box.style.borderRadius = "10px";
      box.style.fontWeight = "500";
      form.appendChild(box);
    }
    box.style.background = ok ? "#e7f7ee" : "#fdeaea";
    box.style.color = ok ? "#0f7a3d" : "#b42318";
    box.textContent = text;
  }

  var forms = document.querySelectorAll("#main form, footer form.newsletter");
  forms.forEach(function (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var data = new FormData(form);
      data.append("form_type", form.getAttribute("data-form-type") || pageType);

      var btn = form.querySelector('[type="submit"], button:not([type])');
      if (btn) btn.disabled = true;

      fetch(new URL("submit", location.href).toString(), {
        method: "POST",
        headers: { "X-CSRF-Token": csrf },
        body: data,
        credentials: "same-origin",
      })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          message(form, !!res.ok, res.message || (res.ok ? "Thank you!" : "Please try again."));
          if (res.ok) form.reset();
        })
        .catch(function () { message(form, false, "Network error. Please try again."); })
        .finally(function () { if (btn) btn.disabled = false; });
    });
  });
})();
