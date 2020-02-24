let selectAll = document.querySelector('.select-all');
let rowSelectors = document.querySelectorAll('.select-row');
let actionOverlay = document.querySelector('.action-overlay');
let ellipsis = document.querySelector('.table-ellipsis');
let countVis = document.querySelector('.items-selected');
let count = 0;

document.getElementById('delete').addEventListener('click', (e) => {
    let checked = getChecked();
    
    console.log('TEST!');

    let succes = true;

    checked.forEach((id) => {
        let fd = new FormData();
        fd.append('id', id);
        
        DoAjaxFormPost('actions/delete-record', fd, (s) => {
            console.log(s);
            let parsed = JSON.parse(s);

            if(parsed.error) {
                succes = false;
            } else console.log("Succesfully delete record!");
        });
    });

    window.location.reload();
})

selectAll.addEventListener('click', (e) => {
    if(selectAll.checked) {
        rowSelectors.forEach(row => {
            row.checked = true;
        })
        console.log(rowSelectors.length);
        count = rowSelectors.length;
        showActionMenu();
    } else {
        rowSelectors.forEach(row => {
            row.checked = false;
        })
        count = 0;
        hideActionMenu();
    }

    if (count > 1) {
        countVis.innerHTML = count + ' items selected';
    } else {
        countVis.innerHTML = count + ' item selected';
    }
})

rowSelectors.forEach(row => {
    row.addEventListener('click', (e) => {
        if (row.checked) {
            count++;
            showActionMenu(e);
        } else {
            count--;
            hideActionMenu();
        }
        
        if (count > 1) {
            countVis.innerHTML = count + ' items selected';
        } else {
            countVis.innerHTML = count + ' item selected';
        }
    })
})

function getChecked() {

    let rows = [];

    rowSelectors.forEach(row => {
        if(row.checked) {
            rows.push(parseInt(row.dataset.id));
        }
    })

    return rows;
}

// PX Toevoeging
function showActionMenu(e) {
    actionOverlay.style.display = 'block';
}

function hideActionMenu() {
    if (count < 1) {
        actionOverlay.style.display = 'none';
    }
}