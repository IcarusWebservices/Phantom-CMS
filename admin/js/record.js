const form = document.querySelector('#recordsform');

document.getElementById('title').addEventListener('input', (e) => {
    document.getElementById('slug').value = string_to_slug( document.getElementById('title').value );
})

let isInUnsavedState = false;

window.onbeforeunload = () => {

    if(isInUnsavedState) {
        return "There may be some unsaved changes!";
    }

};

if(document.getElementById('delete')) {
    document.getElementById('delete').addEventListener('click', () => {
        let r = confirm('Are you sure you want to delete this record?');
    
        if(r) {
            let fd = new FormData()
            fd.append('id', document.getElementById('system:id').value);
            DoAjaxFormPost('actions/delete-record', fd, (s) => {
                // console.log(s);
                let parsed = JSON.parse(s);
    
                let type = document.getElementById('system:recordtype').value;
    
                if(!parsed.error) {
                    window.open('records-overview?type=' + type, '_self');
                } else console.log("error!");
            });
        }
    })
}

form.addEventListener('submit', (e) => {

    console.log('%c Phantom – Form Submit event triggered...', 'color: #29cc8d; font-weight: bold;');

    e.preventDefault();

    // CheckIfRequiredAreSet();

    let formdata = new FormData(form);

    DoAjaxFormPost('actions/save-record', formdata, (s) => {

        // console.log(s);

        let parsed = JSON.parse(s);

        if(!parsed.error) {

            // Show & hide snackbar
            var snackbar = document.getElementById("snackbar-saved");
            snackbar.className = "show";
            setTimeout(function(){ 
                snackbar.className = snackbar.className.replace("show", ""); 
            }, 2950);

            console.log('%c Phantom – Success!', 'color: #29cc8d; font-weight: bold;');

        } else console.log('%c Phantom – Failure!', 'color: crimson; font-weight: bold;');

        isInUnsavedState = false;

        let type = document.getElementById('system:recordtype').value;
        if(parsed.new) {
            window.open('records-overview?type=' + type, '_self');
        }
    })
})

function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ""); // trim
    str = str.toLowerCase();
  
    // remove accents, swap ñ for n, etc
    var from = "åàáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaaaeeeeiiiioooouuuunc------";
  
    for (var i = 0, l = from.length; i < l; i++) {
      str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
    }
  
    str = str
      .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
      .replace(/\s+/g, "-") // collapse whitespace and replace by -
      .replace(/-+/g, "-") // collapse dashes
      .replace(/^-+/, "") // trim - from start of text
      .replace(/-+$/, ""); // trim - from end of text
  
    return str;
  }