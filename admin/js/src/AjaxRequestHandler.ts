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