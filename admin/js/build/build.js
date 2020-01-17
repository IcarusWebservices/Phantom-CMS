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
        console.log(r.requestDataIsValid);
        console.log(r.requestData);
        return r;
    }
};
//# sourceMappingURL=build.js.map