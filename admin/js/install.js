let download = document.getElementById('download')
let install = document.getElementById('install')
let stat = document.getElementById('status')
let id = document.getElementById('ID')

download.addEventListener('click', e => {
    stat.innerHTML = 'Downloading ZIP...'

    DoAjaxGet('admin/actions/install-release?step=1&id=' + id.innerHTML, s => {
        stat.innerHTML = 'ZIP downloaded!'
    })
})

install.addEventListener('click', e => {

})
