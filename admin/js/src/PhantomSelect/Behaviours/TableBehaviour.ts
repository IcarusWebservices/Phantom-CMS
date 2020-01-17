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

        return {
            allSelector: allSelector,
            element: tableElement
        };
    }

}