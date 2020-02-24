document.querySelectorAll('.deleteterm').forEach(el => {
    el.addEventListener('click', (e) => {
        let target = e.target;

        let id = target.dataset.id;

        let fd = new FormData();
        fd.append('id', id);

        DoAjaxFormPost('actions/taxonomy?action=delete', fd, (s) => {
            window.location.reload();
        })
    })
})

document.querySelectorAll('.addterm').forEach(el => {
    el.addEventListener('click', (e) => {
        let target = e.target;

        let type = target.dataset.forType;
        let value = document.getElementById(type + ':term').value;
        let id = target.dataset.record;

        let fd = new FormData();
        fd.append('value', value);
        fd.append('type', type);
        fd.append('recordid', id);

        DoAjaxFormPost('actions/taxonomy?action=add', fd, (s) => {
            window.location.reload();
        })
    })
})

document.getElementById('addtype').addEventListener('click', (e) => {
    let name = document.getElementById('typeaddname').value;
    let value = document.getElementById('typeaddfirst').value;
    let record = document.getElementById('addtype').dataset.record;

    let fd = new FormData();
    fd.append('value', value);
    fd.append('type', name);
    fd.append('recordid', record);

    DoAjaxFormPost('actions/taxonomy?action=add', fd, (s) => {
        window.location.reload();
    })
});
