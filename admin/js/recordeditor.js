const init = (e) => {
    let s = ph._("#save");
    s.on('click', save);
}

const save = (e) => {
    let f = {};

    let el = ph._('export');

    let ar = el.Arr();

    ar.forEach(em => {
        let sr = em.element;

        let exportid = sr.getAttribute('exportid');
        let datafrom = sr.getAttribute('datafrom');
        let key = sr.getAttribute('keyname');

        let spl = datafrom.split('@');

        let elid = spl[0];
        let extr = spl[1];
        

        let sourceel = ph._(`#${elid}`);

        let output = '';

        sourceel = sourceel.Arr();

        if(sourceel.length > 0) {
            switch(extr) {
                case "innerHTML":
                    let r = sourceel[0];
                    output = r.element.value;
                break;
            }
        }

        f[exportid] = {};
        f[exportid][key] = output;
        
    });

    ph.Api.updateRecord('example', 1, f).then((d) => {
        console.log(d);
    }).catch((d) => {
        console.log(d);
    });
}

window.addEventListener('load', init);