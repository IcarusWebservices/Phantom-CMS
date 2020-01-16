class AjaxManager {

    doRequest(data, callback) {
        this.request = new XMLHttpRequest();

        var method = data.method;
        var uri = data.uri;

        this.request.open(method, uri);

        var l = this;

        this.request.onreadystatechange = function() {
            if(this.readyState == 4) {
                callback(l.request.responseText, this.status);
            }
        }

        if(method == "POST" && data.formData) {
            var formData = new FormData();

            var keys = Object.keys(data.formData);

            keys.forEach(key => {
                var element = data.formData[key];

                formData.append(key, element);
            });

            this.request.send(formData);
        } else {
            this.request.send();
        }

    }

}