console.log('%c Phantom – Components JS initiated!', 'color: #29cc8d; font-weight: bold;');

const modal = document.querySelectorAll(".modal");

if (modal) {
    modal.forEach((el) => {
        let modalContent = el.querySelector('.modal-content');
        let modalCloseBtn = el.querySelector('.close-modal');
        let modalCancelBtn = el.querySelector('.button.cancel');
        
        el.addEventListener('click', () => {
            el.style.display = "none";
        });

        modalContent.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        modalCloseBtn.addEventListener('click', () => {
            el.style.display = "none";
        });

        modalCancelBtn.addEventListener('click', () => {
            el.style.display = "none";
        });
    });
}