document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function() {
        let searchQuery = this.value.trim();
        if (searchQuery === '') {
            searchResults.innerHTML = '';
            return;
        }

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'search.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let results = JSON.parse(xhr.responseText);
                let text = '';
                results.forEach(function(result) {
                    text = text + "<li>" + result['name'] + " (" + result['amount'] + "記事)" + "</li>";
                });
                searchResults.innerHTML = text;
            }
        };
        xhr.send('query=' + encodeURIComponent(searchQuery));
    });
});
