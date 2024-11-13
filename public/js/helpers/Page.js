export class Page{

    static redirect(location){
        window.location = location;
    }

    static reload(){
        window.location.reload();
    }

    static tableUrl(URL, id){
        let parts = URL.split("?");
        if (parts.length === 2) {
            let [baseUrl, queryParams] = parts;
            return `${baseUrl}/${id}?${queryParams}`;
        }
        return `${URL}/${id}`;
    }

}
