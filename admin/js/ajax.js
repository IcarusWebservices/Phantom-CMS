const DoAjaxFormPost = (url, form, callback) => {

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = (r) => {
        if(xhr.readyState == 4) {
            callback( xhr.responseText, xhr.readyState );
        }
    }
    // console.log("Working?");
    xhr.open("POST", url, true);
    xhr.send(form);

}

const DoAjaxGet = (url, callback) => {
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = (r) => {
        if(xhr.readyState == 4) {
            callback( xhr.responseText, xhr.readyState );
        }
    }
    // console.log("Working?");
    xhr.open("GET", url, true);
    xhr.send();
}