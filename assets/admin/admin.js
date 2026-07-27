/* Admin panel behaviour — sidebar toggle, delete confirm, image preview */
(function () {
  var burger = document.querySelector('[data-burger]');
  var sidebar = document.querySelector('.sidebar');
  var backdrop = document.querySelector('.backdrop');
  function toggle(open) {
    if (!sidebar) return;
    sidebar.classList.toggle('open', open);
    backdrop && backdrop.classList.toggle('show', open);
  }
  burger && burger.addEventListener('click', function () { toggle(!sidebar.classList.contains('open')); });
  backdrop && backdrop.addEventListener('click', function () { toggle(false); });

  // Confirm destructive actions
  document.addEventListener('submit', function (e) {
    var f = e.target;
    if (f.matches('[data-confirm]') && !confirm(f.getAttribute('data-confirm') || 'Are you sure?')) {
      e.preventDefault();
    }
  });

  // Live image preview for file inputs
  document.querySelectorAll('input[type=file][data-preview]').forEach(function (input) {
    input.addEventListener('change', function () {
      var target = document.getElementById(input.getAttribute('data-preview'));
      if (target && input.files && input.files[0]) {
        target.src = URL.createObjectURL(input.files[0]);
        target.style.display = 'block';
      }
    });
  });
})();
