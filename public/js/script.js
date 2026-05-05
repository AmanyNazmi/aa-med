document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('searchForm');
  const input = document.getElementById('q');
  const icon  = document.getElementById('submitIcon');

  function go() {
    if (!input) return;
    const q = (input.value || '').trim();
    if (!q) return;
    window.location.href = '/view?q=' + encodeURIComponent(q);
  }

  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      go();
    });
  }

  if (icon) {
    icon.addEventListener('click', go);
  }
});
