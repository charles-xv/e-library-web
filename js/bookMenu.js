const menuToggle = document.getElementById('menuToggle');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    // Open sidebar
    menuToggle.addEventListener('click', () => {
      sidebar.classList.add('active');
      mainContent.classList.add('blur');
    });

    // Close sidebar
    closeSidebar.addEventListener('click', () => {
      sidebar.classList.remove('active');
      mainContent.classList.remove('blur');
    });

    // Close sidebar when clicking outside
    window.addEventListener('click', (e) => {
      if (e.target === mainContent) {
        sidebar.classList.remove('active');
        mainContent.classList.remove('blur');
      }
    });