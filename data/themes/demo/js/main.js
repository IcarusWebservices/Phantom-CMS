const MenuButton = document.getElementById('hamburger-expand');
const Menu = document.getElementById('navbarBasicExample');

MenuButton.addEventListener('click', (e) => {
    if(Menu.style.display == "none") Menu.style.display = "block";
    else if(!Menu.style.display) Menu.style.display = "block";
    else Menu.style.display = "none";
})