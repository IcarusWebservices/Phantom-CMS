const createUserModal = document.getElementById("user-creation");
const createUserModalCloseBtn = document.querySelector("#user-creation .close-modal");
const createUserModalCancelBtn = document.querySelector("#user-creation .button.cancel");

window.onclick = (e) => {
    if (e.target == createUserModal) {
        createUserModal.style.display = "none";
    }
}
createUserModalCloseBtn.onclick = (e) => {
    createUserModal.style.display = "none";
}
createUserModalCancelBtn.onclick = (e) => {
    createUserModal.style.display = "none";
}


document.getElementById('newuseropen').addEventListener('click', (e) => {
    createUserModal.style.display = 'block';
});

document.getElementById('createuser').addEventListener('click', (e) => {
    let form = document.getElementById('newuserform');
    let fd = new FormData(form);
    DoAjaxFormPost('actions/user?action=create', fd, (s) => {
        window.location.reload();
    });
});

document.querySelectorAll('.delete-user').forEach(b => {
    b.addEventListener('click', (e) => {
        let id = e.target.dataset.deleteId;
        DoAjaxFormPost('actions/user?action=delete&id=' + id, null, (s) => {
            window.location.reload();
        });
    })
});