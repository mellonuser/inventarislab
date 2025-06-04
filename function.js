function loadDashboardStats() {
    fetch('api/dashboardAPI.php?action=stats')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('total-items').innerText = data.data.totalItems;
                document.getElementById('borrowed-items').innerText = data.data.borrowedItems;
                document.getElementById('available-items').innerText = data.data.availableItems;
                document.getElementById('total-users').innerText = data.data.totalUsers;
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error fetching stats:', error));
}

function loadRecentBorrowings() {
    fetch('api/dashboardAPI.php?action=recent')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const recentBorrowingsTable = document.getElementById('recent-borrowings');
                recentBorrowingsTable.innerHTML = ''; // Clear existing rows
                data.data.forEach(borrowing => {
                    const row = `<tr>
                                    <td>${borrowing.TANGGALPINJAM}</td>
                                    <td>${borrowing.NAMAUSER}</td>
                                    <td>${borrowing.NAMABARANG}</td>
                                    <td><span class="status-badge status-borrowed">${borrowing.status}</span></td>
                                 </tr>`;
                    recentBorrowingsTable.innerHTML += row;
                });
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error fetching recent borrowings:', error));
}

// Call the functions to load data
loadDashboardStats();
loadRecentBorrowings();

        // Navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('.section');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('active'));
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Hide all sections
                    sections.forEach(section => section.classList.add('hidden'));
                    // Show target section
                    const targetSection = this.getAttribute('data-section');
                    document.getElementById(targetSection).classList.remove('hidden');
                });
            });
            
            // Search functionality
            const searchInput = document.getElementById('search-items');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const tableRows = document.querySelectorAll('#items-table tr');
                    
                    tableRows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            }
        });
        
        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        // Close modal when clicking X or outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('close')) {
                e.target.closest('.modal').style.display = 'none';
            }
            if (e.target.classList.contains('modal')) {
                e.target.style.display = 'none';
            }
        });
        
        // Form submissions (placeholder - integrate with PHP backend)
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Form submitted! Integrate with PHP backend untuk menyimpan ke database.');
                // Close modal after submit
                this.closest('.modal').style.display = 'none';
            });
        });
        
        // Sample data management functions (replace with PHP AJAX calls)
        function loadDashboardStats() {
            // This would be an AJAX call to PHP backend
            // Example: fetch('api/stats.php').then(response => response.json())
            console.log('Loading dashboard stats from database...');
        }
        
        function loadItems() {
            // AJAX call to load items from BARANG table
            console.log('Loading items from database...');
        }
        
        function addItem(itemData) {
            // AJAX call to add item to database
            console.log('Adding item to database:', itemData);
        }
        
        function addBorrowing(borrowData) {
            // AJAX call to add borrowing record
            console.log('Adding borrowing record:', borrowData);
        }
        
        // Initialize dashboard
        loadDashboardStats();