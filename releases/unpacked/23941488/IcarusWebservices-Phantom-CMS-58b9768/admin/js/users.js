let modal = document.getElementById("user-creation");

document.getElementById('newuseropen').addEventListener('click', (e) => {
    modal.style.display = 'block';
})

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

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