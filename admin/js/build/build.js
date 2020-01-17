const PhantomAjaxRequest = class {
    constructor(requestData) {
        this.requestData = requestData;
        this.validateThisRequestData();
    }
    doRequest() {
        let l = this;
        return new Promise((resolve, reject) => {
            const requestData = l.requestData;
            let rq = new XMLHttpRequest();
            rq.onreadystatechange = function () {
                if (this.readyState == 4) {
                    let result = rq.responseText;
                    if (this.status == 200) {
                        resolve({
                            response: result
                        });
                    }
                    else {
                        reject({
                            response: result
                        });
                    }
                }
            };
            let uri = requestData["uri"];
            let method = requestData["method"];
            rq.open(method, uri);
            if (requestData["body"]) {
                rq.send(requestData["body"]);
            }
            else {
                rq.send();
            }
        });
    }
    validateThisRequestData() {
        let requestData = this.requestData;
        let parameterConfiguration = {
            uri: {
                isRequired: true
            },
            method: {
                default: 'GET',
                isRequired: false
            }
        };
        let parameterConfigProcessingKeys = Object.keys(parameterConfiguration);
        let stateOK = true;
        parameterConfigProcessingKeys.forEach(key => {
            let element = parameterConfiguration[key];
            if (element["isRequired"]) {
                if (!requestData[key]) {
                    stateOK = false;
                }
            }
            else if (!requestData[key]) {
                if (element["default"]) {
                    requestData[key] = element["default"];
                }
            }
        });
        this.requestData = requestData;
        this.requestDataIsValid = stateOK;
    }
};
const ph = {
    AjaxRequest: function (requestData) {
        let r = new PhantomAjaxRequest(requestData);
        return r.doRequest();
    },
    _: function (query) {
        let result = document.querySelectorAll(query);
        let selection = new PhantomSelection(result);
        return selection;
    },
    Api: {
        setCurrentWorkingProject: function (projectName) {
            return new Promise((resolve, reject) => {
                let formBody = new FormData();
                formBody.append("project_name", projectName);
                ph.AjaxRequest({
                    uri: ph.Constants.API_BASE_URI + 'projects/set-working-project',
                    method: 'POST',
                    body: formBody
                }).then(() => resolve()).catch(() => reject());
            });
        }
    },
    Constants: {
        API_BASE_URI: 'api/'
    }
};
class PhantomElementWrapper {
    constructor(element) {
        this.element = element;
    }
    on(event, callback) {
        this.element.addEventListener(event, (e) => callback(e));
    }
    _(query) {
        let result = this.element.querySelectorAll(query);
        return new PhantomSelection(result);
    }
}
class PhantomSelection {
    constructor(selection) {
        this.selection = [];
        this.behaviourClasses = [];
        let l = this;
        selection.forEach(element => {
            console.log(l);
            l.selection.push(new PhantomElementWrapper(element));
        });
        return this;
    }
    on(event, callback) {
        this.selection.forEach((e) => {
            e.on(event, callback);
        });
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
class PhantomTableBehaviour {
    init(selection) {
        let l = this;
        l.tables = [];
        selection.Arr().forEach(element => {
            l.tables.push(this.handleTable(element));
        });
    }
    handleTable(tableElement) {
        let allSelector = tableElement._('[type="checkbox"][data-behaviour="tableCheckboxSelectAll"]');
        return {
            allSelector: allSelector,
            element: tableElement
        };
    }
}
//# sourceMappingURL=build.js.map