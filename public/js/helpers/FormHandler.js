import {Requester} from "./Requester.js";
export class FormHandler {

    static initial(forms = null){
        return (new FormHandler(forms)).activate();
    }

    constructor(forms = null) {
        this.forms = forms;
        this.onErrorCallback = (error) => {
            console.log(error)
        };
        this.onSuccessCallback = (response) => {
            console.log(response)
        };
        this.onProgressCallback = (event) => {
            if (event.lengthComputable) {
                let percentage = ((event.loaded / event.total) * 100).toFixed(2) + '%';
                console.log(percentage);
            }
        };
    }

    activate(forms = null){
        if(forms !== null) this.forms = forms;
        this.forms = Array.from(document.querySelectorAll(this.forms));
        this.forms.forEach(form => {
            this.onSubmit(form);
        });
        return this;
    }

    onSubmit(form){
        form.addEventListener('submit', event => {
            event.preventDefault();
            if(form.classList.contains('ignore-submit')) return false;
            if(form.getAttribute("data-transfer") === "on") return false;
            form.setAttribute("data-transfer", "on");
            const formData = this.collectFormData(form);
            this.onRequest(formData, form.action, () => {
                form.setAttribute("data-transfer", "off");
            }, formData.get('_token'), form.method);
        });
        return this;
    }

    onValidate(form){

    }

    onRequest(formData, URL, then = null, token = null, method = "POST"){
        let requester = new Requester;
        let success = this.onSuccessCallback, error = this.onErrorCallback, progress = this.onProgressCallback;
        method = method.toUpperCase();
        let headers = {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        };
        if(method !== "POST"){
            headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }
        let request = requester.URL(URL).setFormData(formData).setHeaders(headers)
        .onError((code, statusText, message) => {
            if(typeof then === 'function') then();
            let errors = JSON.parse(message);
            return error(errors.message)
        }).onSuccess((response) => {
            if(typeof then === 'function') then();
            response = JSON.parse(response);
            if(!response.pass) return error(response.message)
            return success(response)
        }).onProgress((event) => {
            return progress(event)
        });
        return method === "POST" ? request.post() : request.patch();
    }

    collectFormData(form){
        const inputs = Array.from(form.querySelectorAll('input, select, textarea'));
        const formData = new FormData();
        for(let i = 0; i < inputs.length; i++){
            let input = inputs[i];
            let value = null;
            if(input.name.endsWith('[]')) {
                if(formData.has(input.name)) continue;
                let inputs = Array.from(form.querySelectorAll("input[name='" + input.name + "']"));
                value = this.inputArrayValue(inputs, input.name);
            }else {
                if(!this.valueFilter(input)) continue;
                value = this.inputSingleValue(input);
            }
            formData.append(value.name, value.value)
        }
        return formData;
    }

    collectSearchData(form){
        const inputs = Array.from(form.querySelectorAll('input, select'));
        let formData = "";
        for(let i = 0; i < inputs.length; i++){
            let input = inputs[i];
            let value = this.inputSingleValue(input);
            if(formData) formData += "&";
            if(input.hasAttribute('data-trigger')){
                let trigger = input.getAttribute('data-trigger');
                if(trigger == "skip") continue;
                if(trigger == "between:"){
                    let related = document.querySelector("input[name=" +
                        input.getAttribute('data-related-date') + "]").value;
                    formData += input.name + "=between:" + value.value + "," + related;
                    continue;
                }
                formData += input.name + "=" + input.getAttribute('data-trigger') + value.value;
                continue;
            }
            formData += input.name + "=" + value.value;
        }
        return encodeURI(formData);
    }

    inputSingleValue(input){
        return {
            name: input.name,
            value: input.type === "file" ?
                (!input.files.length ? "" : (input.files.length > 1 ? [] : input.files[0])) : input.value

        };
    }

    inputArrayValue(inputs, name){
        return {
            name: name,
            value: inputs.filter(input => this.valueFilter(input)).map((input) => {
                if(input.type === "file"){
                    if(input.files.length > 1) return input.files;
                    return input.files[0];
                }
                return input.value;
            })
        };
    }

    valueFilter(input){
        if(input.classList !== undefined && input.classList.contains('data-ignore')) return false;
        if(input.getAttribute("type") !== "checkbox" && input.getAttribute("type") !== "radio") return true;
        return input.checked;
    }

    onValidationFail(callback){
        this.onValidateCallback = callback;
        return this;
    }

    onError(callback){
        this.onErrorCallback = callback;
        return this;
    }

    onSuccess(callback){
        this.onSuccessCallback = callback;
        return this;
    }

    onProgress(callback){
        this.onProgressCallback = callback;
        return this;
    }

}
