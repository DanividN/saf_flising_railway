document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('search-input');
    if (searchInput) {
        var searchUrl = searchInput.getAttribute('data-search-url');
        searchInput.addEventListener('input', function() {
            var search = this.value;
            fetch(searchUrl + '?search=' + encodeURIComponent(search))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    document.getElementById('resultados-busqueda').innerHTML = html;
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        });
    }

});