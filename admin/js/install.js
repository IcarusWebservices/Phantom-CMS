(() => {

    let idElement = document.getElementById('update-id')
    let pBar = document.getElementById('install-progress')
    let taskText = document.getElementById('tasktext');

    if(idElement) {

        let id = idElement.innerHTML;

        // DoAjaxGet('actions/install-release?step=1&id=' + id, (s) => {
        //     if(s) {
        //         pBar.value = 25;
        //         taskText.innerHTML = 'Downloading release...'
        //         DoAjaxGet('actions/install-release?step=2&id=' + id, (a) => {
        //             if(a) {
        //                 pBar.value = 50;
        //                 taskText.innerHTML = 'Unpakking...'
        //                 DoAjaxGet('actions/install-release?step=3&id=' + id, (b) => {
        //                     if(b) {
        //                         pBar.value = 75;
        //                         taskText.innerHTML = 'Installing...'
        //                         DoAjaxGet('actions/install-release?step=4&id=' + id, (c) => {
        //                             if(c) {
        //                                 console.log(c);
        //                             }
        //                         });
        //                     }
        //                 });
        //             }
        //         });
        //     }
        // });

        DoAjaxGet('actions/install-release?step=4&id=' + id, (c) => {
            if(c) {
                console.log(c);
            }
        });

    }

})();