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