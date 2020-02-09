class PhantomElementWrapper {

    element: Element;

    constructor(element: Element) {
        this.element = element;
    }

    on(event:string, callback:Function) {
        this.element.addEventListener(event, (e) => callback(e));
    }

    _(query: string) {
        let result = this.element.querySelectorAll(query);
        return new PhantomSelection(result);
    }

}