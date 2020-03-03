// The customizer script

let b = document.querySelectorAll('.__customizer_editor_open')

if(b) {
    b.forEach((el) => el.addEventListener('click', e => {
        e.preventDefault()
        let element = e.target
        
        if(element.dataset.slug) {
            let s = element.dataset.slug

            let modal = document.querySelector(`.__c_modal[data-slug="${s}"]`)

            if(modal) {
                modal.style.display = 'block';
            }
        }
    }))
}