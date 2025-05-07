// filepath: c:\xampp\htdocs\startour\CY-Star-Tour\js\search.js
document.addEventListener('DOMContentLoaded', () => {
    const filters = {
        galaxy: [],
        keywords: [],
        rating: [],
        price: null,
    };

    const planetElements = document.querySelectorAll('.booking'); // Class booking


    
    const updateFilters = () => {
        planetElements.forEach(planet => {
            let hasResults = false;

            const galaxy = planet.getAttribute('data-galaxy');
            const keywords = planet.getAttribute('data-keywords').split(',');
            const rating = planet.getAttribute('data-rating');
            const price = parseInt(planet.getAttribute('data-price'), 10);

            // Check if the planet matches each one of the filters
            const matchesGalaxy = !filters.galaxy.length || filters.galaxy.includes(galaxy);
            const matchesKeywords = !filters.keywords.length || filters.keywords.every(keyword => keywords.includes(keyword));
            const matchesRating = !filters.rating.length || filters.rating.includes(rating);
            const matchesPrice = !filters.price || price <= filters.price;

            // Show or hide the planet based on the filters
            if (matchesGalaxy && matchesKeywords && matchesRating && matchesPrice) {
                planet.style.display = 'block';
                hasResults = true;
            } else {
                planet.style.display = 'none';
            }
        });
        const noResultsMessage = document.getElementById('no-results');
        noResultsMessage.style.display = hasResults ? 'none' : 'block';
    };

    // Add event listeners to filter inputs
    const addFilterListeners = (selector, filterKey, isMultiple = true) => {
        document.querySelectorAll(selector).forEach(input => {
            input.addEventListener('change', () => {
                if (isMultiple) {
                    if (input.checked) {
                        filters[filterKey].push(input.value.toLowerCase());
                    } else {
                        filters[filterKey] = filters[filterKey].filter(value => value !== input.value.toLowerCase());
                    }
                } else {
                    filters[filterKey] = input.checked ? input.value : null;
                }
                updateFilters();
            });
        });
    };

    // Add listeners for each filter type
    addFilterListeners('input[name="galaxy[]"]', 'galaxy');
    addFilterListeners('input[name="keywords[]"]', 'keywords');
    addFilterListeners('input[name="rating[]"]', 'rating');
    addFilterListeners('input[name="price"]', 'price', false);

    // Valid = reset button flm de changer
    document.querySelector('.valid').addEventListener('click', () => {
        // Reset all filters button
        filters.galaxy = [];
        filters.keywords = [];
        filters.rating = [];
        filters.price = null;
    
        // Uncheck all inputs
        document.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(input => {
            input.checked = false;
        });
    
        updateFilters();
    });
});