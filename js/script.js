document.querySelectorAll('.thumbnails img').forEach(thumb => {
    thumb.addEventListener('click', function() {
        document.querySelector('.main-image').src = this.src;
    });
});

document.getElementById('hamburger').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    if (sidebar.style.display === 'block') {
        sidebar.style.display = 'none';
    } else {
        sidebar.style.display = 'block';
    }
});

document.getElementById('search-bar').addEventListener('input', function() {
    var query = this.value.toLowerCase();
    var products = document.querySelectorAll('.product-item');
    
    products.forEach(function(product) {
        var productName = product.querySelector('h3').textContent.toLowerCase();
        var productDetails = product.textContent.toLowerCase();
        
        if (productName.includes(query) || productDetails.includes(query)) {
            product.style.display = '';
        } else {
            product.style.display = 'none';
        }
    });
});

document.querySelectorAll('.filter-link').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        var filter = this.dataset.filter.toLowerCase();
        var products = document.querySelectorAll('.product-item');

        products.forEach(function(product) {
            var categories = product.dataset.categories.toLowerCase();
            
            if (categories.includes(filter)) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
            }
        });
    });
});
