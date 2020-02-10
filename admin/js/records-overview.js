let selectAll = document.querySelector('.select-all');

let rowSelectors = document.querySelectorAll('.select-row');

selectAll.addEventListener('click', (e) => {
    if(selectAll.checked) {
        rowSelectors.forEach(row => {
            row.checked = true;
        })
    } else {
        rowSelectors.forEach(row => {
            row.checked = false;
        })
    }
})

function getChecked() {

    let rows = [];

    rowSelectors.forEach(row => {
        if(row.checked) {
            rows.push(row.dataset.id);
        }
    })

    console.log(rows);
}