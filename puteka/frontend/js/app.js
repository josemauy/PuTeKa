function cargar(endpoint, tablaID) {
    fetch(`../backend/router.php?route=${endpoint}`)
    .then(res => res.json())
    .then(data => {
        let html = "";
        data.forEach(obj => {
            html += "<tr>";
            Object.values(obj).forEach(val => {
                html += `<td>${val}</td>`;
            });
            html += "</tr>";
        });
        document.getElementById(tablaID).innerHTML = html;
    });
}