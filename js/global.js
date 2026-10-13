// 🌍 global.js — shared menu logic
const menuToggle = document.getElementById('menuToggle');
const closeSidebar = document.getElementById('closeSidebar');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');

if (menuToggle && sidebar && mainContent) {
  menuToggle.addEventListener('click', () => {
    sidebar.classList.add('active');
    mainContent.classList.add('blur');
  });

  if (closeSidebar) {
    closeSidebar.addEventListener('click', () => {
      sidebar.classList.remove('active');
      mainContent.classList.remove('blur');
    });
  }

  window.addEventListener('click', (e) => {
    if (e.target === mainContent) {
      sidebar.classList.remove('active');
      mainContent.classList.remove('blur');
    }
  });
}
