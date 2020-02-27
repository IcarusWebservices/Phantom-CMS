console.log('%c Phantom – Javascript initiated!', 'color: #29cc8d; font-weight: bold;');

const actionbar = document.querySelector('.actionbar');
const sidebar = document.querySelector('.menu');
const sidebarBurger = document.querySelector('.menu-burger');
const accordionTitles = document.querySelectorAll('.accordion-title');

const actionDropdownBtn = document.querySelector('.actionbar .action-ddb');
const actionDropdown = document.querySelector('.actionbar .action-dropdown');
const notificationDropdownBtn = document.querySelector('.actionbar .notification-ddb');
const notificationDropdown = document.querySelector('.actionbar .notification-dropdown');

var menuState = 1; // 1 = visible, 0 = hidden
var actionDropdownState = 0;
var notificationDropdownState = 0;


// Sidebar State
menuStateWidth();
window.onresize = menuStateWidth();

function menuStateWidth() {
    if (window.innerWidth <= 768) {
        actionbar.classList.add('full');
        sidebar.classList.add('hidden');
        menuState = 0;
    } else {
        actionbar.classList.remove('full');
        sidebar.classList.remove('hidden');
        menuState = 1;
    }
}

sidebarBurger.onclick = () => {
    if (menuState == 1) {
        actionbar.classList.add('full');
        sidebar.classList.add('hidden');
        menuState = 0;
        console.log('%c New menuState = ' + menuState, 'color: red;');
    } else {
        actionbar.classList.remove('full');
        sidebar.classList.remove('hidden');
        menuState = 1;
        console.log('%c New menuState = ' + menuState, 'color: green;');
    }
}

accordionTitles.forEach(acc => {
    acc.addEventListener('click', (e) => {
        if (!event.target.classList.contains('active')) {
            event.target.classList.toggle('clicked');
        }
    })
});

// Actionbar Dropdowns State
actionDropdownBtn.onclick = (e) => {
    e.stopPropagation();
    if (notificationDropdownState == 1) {
        closeNotificationDropdown();
    }
    if (actionDropdownState == 1) {
        closeActionDropdown();
    } else {
        openActionDropdown();
    }
}

notificationDropdownBtn.onclick = (e) => {
    e.stopPropagation();
    if (actionDropdownState == 1) {
        closeActionDropdown();
    }
    if (notificationDropdownState == 1) {
        closeNotificationDropdown();
    } else {
        openNotificationDropdown();
    }
}

document.onclick = () => {
    if (actionDropdownState == 1) {
        closeActionDropdown();
    }
    if (notificationDropdownState == 1) {
        closeNotificationDropdown();
    }
}

function closeActionDropdown() {
    actionDropdown.style.display = 'none';
    actionDropdownState = 0;
}

function openActionDropdown() {
    actionDropdown.style.display = 'block';
    actionDropdownState = 1;
}

function closeNotificationDropdown() {
    notificationDropdown.style.display = 'none';
    notificationDropdownState = 0;
}

function openNotificationDropdown() {
    notificationDropdown.style.display = 'block';
    notificationDropdownState = 1;
}

actionDropdown.onclick = (e) => {
    e.stopPropagation();
}

notificationDropdown.onclick = (e) => {
    e.stopPropagation();
}


// Site Selector
let select = document.getElementById("siteselect");
if (select) {
    select.addEventListener('change', (e) => {
        let lang = select.options[select.selectedIndex].value;
        window.open('<?= $site_uri ?>site=' + lang, '_self');
    })
}