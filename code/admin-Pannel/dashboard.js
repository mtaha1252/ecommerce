//  sidebar
document.querySelector('.menu-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('sidebar-open')) {
      sidebar.classList.remove('sidebar-open');
    } else {
      sidebar.classList.add('sidebar-open');
    }
  });
  

