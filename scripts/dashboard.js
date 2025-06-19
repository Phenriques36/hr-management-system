document.addEventListener('DOMContentLoaded', function () {
  const wideCard = document.querySelector('.kpi-card.wide');
  const expandIcon = wideCard.querySelector('.expand-icon');

  expandIcon.addEventListener('click', function () {
    wideCard.classList.toggle('expanded');
    // Optionally swap icon between expand/collapse
    if (wideCard.classList.contains('expanded')) {
      expandIcon.textContent = 'close_fullscreen';
    } else {
      expandIcon.textContent = 'open_in_full';
    }
  });
});