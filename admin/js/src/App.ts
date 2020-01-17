const ph = {

    AjaxRequest: function(requestData: Object) {
        let r = new PhantomAjaxRequest(requestData);
        console.log(r.requestDataIsValid);
        console.log(r.requestData);
        return r;
    }

}