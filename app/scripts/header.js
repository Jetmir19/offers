'use strict';

// Loading Spinner Remove
window.onload = function () {
    setTimeout(() => document.getElementById("main-spinner").remove(), 400);
}

// First time page loaded
document.addEventListener("DOMContentLoaded", function (event) {
    createLeftMenuEvents();
});

// We do so to prevent the parent window to loose focus when print report is clicked
window.addEventListener('focus', () => {
    createLeftMenuEvents();
})

// LEFT menu Dropdown Logic
function createLeftMenuEvents() {
    let menu_links = document.querySelector("#menu-links");
    let navItem = document.querySelectorAll(".nav-item");

    menu_links.onclick = function (e) {
        if (e.target.tagName == 'BUTTON' || e.target.tagName == 'I') {
            let dropdownContent = e.target.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
                e.target.children[1].classList.remove("fa-caret-up");
                e.target.children[1].classList.add("fa-caret-down");
            } else {
                dropdownContent.style.display = "block";
                e.target.children[1].classList.add("fa-caret-up");
                e.target.children[1].classList.remove("fa-caret-down");
            }
        }
    }

    // dropdown menu items (stay open and selected)
    for (let i = 0; i < navItem.length; i++) {
        if (navItem[i].classList.contains('active-page')) {
            let dropdownButton = navItem[i].children[0];
            let dropdownContent = navItem[i].children[1];
            // If link is a dropdown or has a button
            if (dropdownButton !== undefined && dropdownContent !== undefined) {
                dropdownContent.style.display = "block";
                dropdownButton.children[1].classList.add("fa-caret-up");
            }
        }
    }
}