document.getElementById('save-theme').addEventListener('click', () => {
    let val = document.getElementById('theme').value;
    
    let fd = new FormData();

    fd.append('setting_id', 'appearance_theme');
    fd.append('setting_value', val);

    DoAjaxFormPost('actions/save-setting', fd, (s) => {
        let err = JSON.parse(s).error;
        // console.log(s);
        // let err = true;
        if(!err) {
            // Do the stuff!

            var x = document.getElementById("snackbar-saved");

            // Add the "show" class to DIV
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2950);

            console.log('%c Phantom – Success!', 'color: #29cc8d; font-weight: bold;');
        }
    });
});