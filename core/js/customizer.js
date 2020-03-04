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

let form = document.querySelector('#__customizer_form')

if(form) {

    form.addEventListener('submit', e => {
        e.preventDefault();

        let r = new XMLHttpRequest();

        let bp = document.getElementById('__customizer_base_path');

        let basepath;

        if(bp) {
            basepath = bp.innerHTML;
        } else {
            basepath = '/';
        }

        // console.log(basepath);

        r.onreadystatechange = function(e) {
            if(r.readyState == 4) {
                window.location.reload();
            }
        }

        let data = new FormData(form)

        r.open('POST', basepath + 'admin/actions/save-customizer');
        r.send(data);
    })

}