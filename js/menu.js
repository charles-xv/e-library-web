 const hamburger = document.querySelector('.hamburger');
  const overlay = document.querySelector('.nav-overlay');

  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    overlay.classList.toggle('show');
  });

  // Close overlay when clicking a link
  document.querySelectorAll('.overlay-links a').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('active');
      overlay.classList.remove('show');
    });
  });