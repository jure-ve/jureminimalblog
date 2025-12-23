/**
 * Search toggle functionality
 * Minimal vanilla JavaScript for search form toggle
 */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.querySelector('.search-toggle');
        const searchForm = document.querySelector('.header-search-form');
        const searchInput = searchForm ? searchForm.querySelector('input[type="search"]') : null;
        
        if (!toggleBtn || !searchForm) {
            return;
        }
        
        // Toggle search form visibility
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            searchForm.classList.toggle('is-active');
            
            // Focus input when opening
            if (searchForm.classList.contains('is-active') && searchInput) {
                searchInput.focus();
            }
        });
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchForm.classList.contains('is-active')) {
                searchForm.classList.remove('is-active');
            }
        });
    });
})();
