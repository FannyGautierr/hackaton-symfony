const button = document.getElementById('menu-button');
const dropdown = document.getElementById('menu-dropdown');

button.addEventListener('click', () => {
    dropdown.classList.toggle('hidden');
});

document.addEventListener('click', (event) => {
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});

const dropdownContent = document.querySelectorAll('.dropdown-content');
const menuButton = document.querySelector('#menu-button p');

dropdownContent.forEach(item => {
    item.addEventListener('click', function() {
        menuButton.textContent = this.textContent;
    });
});