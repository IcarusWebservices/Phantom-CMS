const form = document.querySelector('#recordsform');

form.addEventListener('submit', (e) => {
    e.preventDefault();

    // CheckIfRequiredAreSet();

    let formdata = new FormData(form);

    DoAjaxFormPost('actions/save-record', formdata, (s) => {
        console.log(s);
    })
})

const DoAjaxFormPost = (url, form, callback) => {

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            callback( xhr.responseText );
        }
    }
    // console.log("Working?");
    xhr.open("POST", url, true);
    xhr.send(form);

}