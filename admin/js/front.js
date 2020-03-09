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
var lastClickedAcc;


// Animation State
document.addEventListener('animationstart', function (e) {
    if (e.animationName === 'slide-down') {
        e.target.classList.add('clicked');
    }
});

document.addEventListener('animationend', function (e) {
    if (e.animationName === 'slide-up') {
        e.target.classList.remove('clicked');
    }
});


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

// Accordion Visibility States
accordionTitles.forEach(acc => {
    acc.addEventListener('click', (e) => {
        if (!e.target.classList.contains('active')) {
            // Auto close accordions on clicking another
            /*if (lastClickedAcc) {
                console.log("Lastclickedacc is not null");
                collapseElement(lastClickedAcc);
            }
            lastClickedAcc = e.target;
            */

            if (e.target.nextElementSibling.classList.contains('clicked')) {
                collapseElement(e.target);
            } else {
                openElement(e.target);
            }
        }
    })
});

function collapseElement(element) {
    element.classList.remove('clicked');
    element.nextElementSibling.classList.remove('clicked');
    element.nextElementSibling.classList.add('collapsing');
    setTimeout(function () {
        element.nextElementSibling.classList.remove('collapsing');
        element.nextElementSibling.classList.add('collapse');
    }, 200);
}

function openElement(element) {
    element.classList.add('clicked');
    element.nextElementSibling.classList.remove('collapse');
    element.nextElementSibling.classList.add('opening');
    setTimeout(function () {
        element.nextElementSibling.classList.remove('opening');
        element.nextElementSibling.classList.add('clicked');
    }, 200);
}


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


