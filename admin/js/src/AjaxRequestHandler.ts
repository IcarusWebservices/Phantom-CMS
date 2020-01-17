const PhantomAjaxRequest = class {

    requestData: Object;

    requestDataIsValid: boolean;

    constructor(requestData: Object) {
        this.requestData = requestData;

        this.validateThisRequestData();
    }

    public doRequest() {

        let l = this;

        return new Promise((resolve, reject) => {
            const requestData = l.requestData;

            let rq = new XMLHttpRequest();

            rq.onreadystatechange = function() {
                if(this.readyState == 4) {
                    let result = rq.responseText;
                    if(this.status == 200) {
                        resolve({
                            response: result
                        });
                    } else {
                        reject({
                            response: result
                        });
                    }
                    
                }
            }

            let uri = requestData["uri"];
            let method = requestData["method"];

            rq.open(method, uri);

            if(requestData["body"]) {
                rq.send(requestData["body"]);
            } else {
                rq.send();
            }

            
        });
        
    }

    protected validateThisRequestData() {
        let requestData = this.requestData;

        let parameterConfiguration = {
            uri: {
                isRequired: true
            },
            method: {
                default: 'GET',
                isRequired: false
            }
        }

        let parameterConfigProcessingKeys = Object.keys(parameterConfiguration);

        let stateOK = true;

        parameterConfigProcessingKeys.forEach(key => {

            let element = parameterConfiguration[key];

            if(element["isRequired"]) {
                if(!requestData[key]) {
                    stateOK = false;
                }
            } else if( !requestData[key] ) {
                if(element["default"]) {
                    requestData[key] = element["default"];
                }
            }

        });
        this.requestData = requestData;
        this.requestDataIsValid = stateOK;
    }

}