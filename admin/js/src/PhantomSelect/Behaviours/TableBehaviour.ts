
class PhantomTableBehaviour implements BehaviourBase {

    tables:Array<object>;

    init(selection:PhantomSelection) {
        let l = this;
        l.tables = [];
        selection.Arr().forEach(element => {
            l.tables.push(this.handleTable(element));
        });
    }

    handleTable(tableElement:PhantomElementWrapper) {

        let allSelector = tableElement._('[type="checkbox"][data-behaviour="tableCheckboxSelectAll"]');

        this.reIndexTableRows(tableElement);

        return {}
    }

    reIndexTableRows(tableElement:PhantomElementWrapper) {
        const body = tableElement._("tbody");
        const rows = body.Arr()[0]._("tr").Arr();

        const l = this;

        rows.forEach((row, index) => {
            let cbox = row._('[type="checkbox"][data-behaviour="tableCheckboxSelectRow"]');

            if(cbox.Arr().length > 0) {
                let checkbox = cbox.Arr()[0];
                checkbox.element["dataset"]["tableIndex"] = index;
            }
        })
    }

}