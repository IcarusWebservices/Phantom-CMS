let download = document.getElementById('download')
let install = document.getElementById('install')
let stat = document.getElementById('status')
let id = document.getElementById('ID')

if(download) {
    download.addEventListener('click', e => {
        stat.innerHTML = 'Downloading ZIP...'
    
        DoAjaxGet('actions/install-release?step=1&id=' + id.innerHTML, s => {
            stat.innerHTML = 'ZIP downloaded!'
            window.location.reload();
        })
    })
}


install.addEventListener('click', e => {
    stat.innerHTML = `Installing ${id.innerHTML}...`

    DoAjaxGet('actions/install-release?step=2&id=' + id.innerHTML, s => {
        stat.innerHTML = 'Installed!'
        window.location.reload();
    })
})
