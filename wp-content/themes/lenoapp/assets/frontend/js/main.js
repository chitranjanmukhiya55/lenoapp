// Sidebar Toggle
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
}

// Close Sidebar on Main Content Click or Outside Click
document.addEventListener('click', function (event) {
    const sidebar = document.getElementById('sidebar');
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isHamburgerClick = event.target.closest('.hamburger');

    if (!isClickInsideSidebar && !isHamburgerClick && sidebar.classList.contains('active')) {
        sidebar.classList.remove('active'); // Close the sidebar
    }
});

// Ensure Sidebar Resizes Correctly
window.addEventListener('resize', function () {
    const sidebar = document.getElementById('sidebar');
    if (window.innerWidth > 768) {
        sidebar.classList.remove('active'); // Show sidebar on larger screens
    }
});

// Dropdown Toggle
function toggleDropdown() {
    const dropdownMenu = document.querySelector('.dropdown-menu');
    dropdownMenu.style.display =
        dropdownMenu.style.display === 'block' ? 'none' : 'block';
}

// Navigate Between Sections
function navigateTo(sectionId) {
    const sections = document.querySelectorAll('#main-content > div');
    sections.forEach(section => section.classList.add('hidden'));
    document.getElementById(sectionId).classList.remove('hidden');
}

// Order History 

// Filter Table Rows Based on Search
document.getElementById('search-orders').addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('.order-history-table tbody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});


// Singup 

function navigateToSignup() {
    window.location.href = "signup.html"; // Replace with the correct path to signup.html
}

// script.js
function showLogin() {
    document.getElementById('signup-form').classList.add('hidden');
    document.getElementById('login-form').classList.remove('hidden');
  }
  
  function showSignup() {
    document.getElementById('login-form').classList.add('hidden');
    document.getElementById('signup-form').classList.remove('hidden');
  }
  