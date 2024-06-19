
document.addEventListener('DOMContentLoaded', function () {
    var menuButton = document.getElementById('menuButton');
    var menuDropdown = document.getElementById('menuDropdown');

    menuButton.addEventListener('click', function () {
        menuDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function (e) {
        if (!menuButton.contains(e.target) && !menuDropdown.contains(e.target)) {
            menuDropdown.classList.add('hidden');
        }
    });
});

function searchDosen() {
    let input = document.getElementById('searchBar').value.toLowerCase();
    let table = document.getElementById('dosenTable');
    let trs = table.getElementsByTagName('tr');

    for (let i = 1; i < trs.length; i++) {
        let tds = trs[i].getElementsByTagName('td');
        if (tds[0].textContent.toLowerCase().includes(input)) {
            trs[i].style.display = '';
        } else {
            trs[i].style.display = 'none';
        }
    }
}
