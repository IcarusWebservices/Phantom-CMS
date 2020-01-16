class Api {

    constructor() {
        this.ajax = new AjaxManager();
    }

    projectSetWorkingDirectory(project, callback) {

        this.ajax.doRequest({
            uri: 'api/projects/set-working-project',
            method: 'POST',
            formData: {
                project_name: project
            }
        }, (response) => {

            callback(response);

        });

    }

}