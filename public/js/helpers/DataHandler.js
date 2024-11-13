import {Requester} from "./Requester.js";
export class DataHandler {
    static initial(forms = null){
        return (new DataHandler(forms));
    }

    constructor() {
        this.onErrorCallback = (error) => {
            console.log(error)
        };
        this.onSuccessCallback = (response) => {
            console.log(response)
        };
        this.onLoadCallback = (event) => {
            if (event.lengthComputable) {
                let percentage = ((event.loaded / event.total) * 100).toFixed(2) + '%';
                console.log(percentage);
            }
        };
    }

    getRequest(URL, then = null){
        this.action(URL, then).get();
    }

    postRequest(URL, data, then = null){
        this.action(URL, then, data).post();
    }

    patchRequest(URL, then = null){
        this.action(URL, then).patch();
    }

    deleteRequest(URL, then = null){
        this.action(URL, then).delete();
    }

    action(URL, then, data = false){
        let requester = new Requester;
        let success = this.onSuccessCallback, error = this.onErrorCallback, progress = this.onLoadCallback;
        let request = requester.URL(URL).setHeaders({
            Accept: 'application/json'
        }).onError((code, statusText, message) => {
            if(typeof then === 'function') then();
            let errors = JSON.parse(message);
            return error(errors.message)
        }).onSuccess((response) => {
            if(typeof then === 'function') then();
            response = JSON.parse(response);
            if(response.pass !== undefined && !response.pass) return error(response.message)
            return success(response)
        }).onProgress((event) => {
            return progress(event)
        })
        if(data){
            request.setFormData(data);
        }
        return request;
    }

    onError(callback){
        this.onErrorCallback = callback;
        return this;
    }

    onSuccess(callback){
        this.onSuccessCallback = callback;
        return this;
    }

    onLoad(callback){
        this.onLoadCallback = callback;
        return this;
    }

}
