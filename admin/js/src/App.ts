const ph = {

    AjaxRequest: function(requestData: Object) {
        let r = new PhantomAjaxRequest(requestData);
        return r.doRequest();
    },

    _: function(query: string) {
        let result = document.querySelectorAll(query);
        let selection = new PhantomSelection(result);
        return selection;
    },

    Api: {

        setCurrentWorkingProject: function(projectName: string) {

            return new Promise((resolve, reject) => {
                let formBody = new FormData();

                formBody.append("project_name", projectName);
    
                ph.AjaxRequest({
                    uri: ph.Constants.API_BASE_URI + 'projects/set-working-project',
                    method: 'POST',
                    body: formBody
                }).then( () => resolve() ).catch( () => reject() )
            })

        }

    },

    Constants: {
        API_BASE_URI: 'api/'
    }

}