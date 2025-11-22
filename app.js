document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector("#btn");
    const input = document.querySelector("#search");
    const resultBox = document.querySelector("#result");

    button.addEventListener("click", () => {
        const query = sanitize(input.value.trim());

        // Build URL with query parameter
        let url = "superheroes.php";
        if (query !== "") {
            url += `?query=${encodeURIComponent(query)}`;
        }

        fetch(url)
            .then(response => response.text())
            .then(data => {
                resultBox.innerHTML = data;
            })
            .catch(error => {
                console.error("Error:", error);
                resultBox.innerHTML = "<p>There was an error.</p>";
            });
    });
});

// Basic sanitization to prevent injecting HTML
function sanitize(str) {
    return str.replace(/[&<>"'`=\/]/g, function (s) {
        return ({
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': "&quot;",
            "'": "&#39;",
            "/": "&#x2F;",
            "`": "&#x60;",
            "=": "&#x3D;"
        })[s];
    });
}
