class PhantomSelection {

    selection: Array<PhantomElementWrapper> = [];
    behaviourClasses: Array<object> = [];

    constructor(selection: NodeListOf<Element>) {
        // this.selection = [];
        let l = this;
        selection.forEach(element => {
            // console.log(l);
            l.selection.push( new PhantomElementWrapper(element) );
        })
        return this;
    }

    on(event:string, callback:Function) {
        this.selection.forEach((e) => {
            e.on(event, callback);
        })
    }

    Arr() {
        return this.selection;
    }

    behaviour(behaviourInstance) {
        behaviourInstance.init(this);
        this.behaviourClasses.push(behaviourInstance);
        return this;
    }

}