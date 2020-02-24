let isInUnsavedState = false;

document.querySelectorAll('.stringbar').forEach(el => {
    el.addEventListener('change', e => {
        isInUnsavedState = true;
    })
})

let select = document.getElementById("langselect");
select.addEventListener('change', (e) => {
    let lang = select.options[select.selectedIndex].value;
    window.open('strings-overview?code=' + lang, '_self');
})


window.onbeforeunload = function() {
    if(isInUnsavedState) {
        return "There are unsaved strings!";
    }
}

document.getElementById('save').addEventListener('click', (e) => {

    let form = document.getElementById('stringscontainer');

    let fd = new FormData(form);

    DoAjaxFormPost('actions/save-strings', fd, (s) => {
        console.log(s);

        var x = document.getElementById("snackbar-saved");

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ 
            x.className = x.className.replace("show", ""); 

            
        }, 2950);

        isInUnsavedState = false;
    })

})