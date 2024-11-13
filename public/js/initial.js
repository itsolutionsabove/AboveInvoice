import {FormHandler} from './helpers/FormHandler.js';
import {DataHandler} from "./helpers/DataHandler.js";
import {Page} from './helpers/Page.js';
import {HTMLElements} from './helpers/HTMLElements.js';

FormHandler.initial("form").onError(function (message){
    HTMLElements.errorPopup(message);
}).onSuccess(function (response){
    if(response.reload) {
        Page.reload();
        return;
    }
    if(response.redirect !== null){
        Page.redirect(response.redirect);
        return;
    }
    HTMLElements.successPopup(response.message);
}).onProgress(function (event) {

});

let tables = document.querySelectorAll('table.api-loader');
tables.forEach((table) => {
    table.setAttribute('original-api-url', table.getAttribute('data-api-url'));
    table.addEventListener("reload", () => {
        if(table.getAttribute("reloading") === "activate") return;
        table.setAttribute("reloading", "activate");
        let columns = table.querySelectorAll('th[data-col]');
        table.querySelector('tbody').innerHTML = HTMLElements.tableTR(
            HTMLElements.tableTD(HTMLElements.preLoader(), true, columns.length + 1));
        if(table.getAttribute('data-api-url') === undefined) return;
        DataHandler.initial().onError((message) => {
            HTMLElements.errorPopup(message)
            table.setAttribute("reloading", "");
        }).onSuccess((response) => {
            let html = "";
            if(response.data){
                let tableInfo = global.page.elements.table;
                let tableSettings = global.data;
                columns = Array.from(columns);
                columns = columns.map((column) => {
                    return column.getAttribute("data-col");
                });
                let lastRecord = response.data.length, current = 0;
                html = response.data.map((row) => {
                    let buttons = "";
                    if(typeof tableSettings.table_options.order !== 'undefined' && tableSettings.table_options.order){
                        if(current++){
                            buttons += HTMLElements.a(
                                tableInfo.order.class,
                                Page.tableUrl(tableSettings.orderingAPI, "up/" + row["id"]), HTMLElements.moveUpIcon()
                            );
                        }
                        if(current !== lastRecord){
                            buttons += HTMLElements.a(
                                tableInfo.order.class,
                                Page.tableUrl(tableSettings.orderingAPI, "down/" + row["id"]), HTMLElements.moveDownIcon()
                            );
                        }
                    }
                    if(tableSettings.table_options.show){
                        buttons += HTMLElements.a(
                            tableInfo.show.class, Page.tableUrl(tableSettings.show, row["id"]), HTMLElements.showIcon()
                        );
                    }
                    if(tableSettings.table_options.delete){
                        buttons += HTMLElements.a(
                            tableInfo.delete.class,
                            Page.tableUrl(tableSettings.dataAPI, row["id"]), HTMLElements.deleteIcon()
                        );
                    }
                    return HTMLElements.tableTR(columns.map((column) => {
                        return HTMLElements.tableTD(row[column] == null ? "-" : row[column]);
                    }).join('') + HTMLElements.tableTD(buttons));
                }).join('');
                table.querySelector('tbody').innerHTML = html;
                table.setAttribute("reloading", "");
                activateTableButtons();
            }
        }).getRequest(table.getAttribute('data-api-url'));
    });
    table.dispatchEvent(new Event("reload"));
});

let activateTableButtons = () => {
    let buttons = document.querySelectorAll('table .apply-delete');
    buttons.forEach( (btn) => {
        btn.addEventListener("click", (event) => {
            event.preventDefault();
            if(btn.getAttribute("dispatching") === "activate") return false;
            btn.setAttribute("dispatching", "activate");
            DataHandler.initial().onError((message) => {
                HTMLElements.errorPopup(message)
                btn.setAttribute("dispatching", "");
            }).onSuccess((response) => {
                btn.setAttribute("dispatching", "");
                if(response.reload) {
                    Page.reload();
                    return;
                }
                btn.closest("table").dispatchEvent(new Event("reload"));
            }).deleteRequest(btn.href);
        });
    });

    activateButtonClick(document.querySelectorAll('table .apply-patch'));
}

let activateButtonClick = (buttons, reloadTables = true) => {
    if(!buttons.length) return;
    buttons.forEach( (btn) => {
        btn.addEventListener("click", (event) => {
            event.preventDefault();
            if(btn.getAttribute("dispatching") === "activate") return false;
            btn.setAttribute("dispatching", "activate");
            DataHandler.initial().onError((message) => {
                HTMLElements.errorPopup(message)
                btn.setAttribute("dispatching", "");
            }).onSuccess((response) => {
                btn.setAttribute("dispatching", "");
                if(response.reload) {
                    Page.reload();
                    return;
                }
                if(response.redirect) {
                    Page.redirect(response.redirect);
                    return;
                }
                if(reloadTables) btn.closest("table").dispatchEvent(new Event("reload"));
            }).patchRequest(btn.href);
        });
    });
};

let activateSearchButtons = () => {
    let buttons = document.querySelectorAll('.table-search-activator');
    buttons.forEach((btn) => {
        btn.addEventListener("click", (event) => {
            event.preventDefault();
            let form = btn.closest('form');
            let data = FormHandler.initial().collectSearchData(form);
            let table = document.querySelector(form.getAttribute("data-target-table"));
            table.setAttribute('data-api-url', table.getAttribute('original-api-url') + "?" + data)
            table.dispatchEvent(new Event("reload"));
        });
    });
}

window.onload = () => {
    activateSearchButtons();
    activateButtonClick(document.querySelectorAll('.lecture-start, .lecture-stop, .lecture-generate'), false);
    let btn = document.querySelector(".copy-lecture-link");
    if(btn){
        btn.addEventListener("click", (event) => {
            navigator.clipboard.writeText(event.target.getAttribute("data-link"))
                .then(() => {
                    HTMLElements.successPopup("copied");
                }).catch(err => {
                    HTMLElements.errorPopup(err);
                });
        });
    }
}

if(typeof loadQrModule !== 'undefined' && loadQrModule === true) {
    document.querySelector('.regenerate-qr').addEventListener('click', (e) => {
        e.preventDefault();
        let btn = e.target;
        btn.setAttribute("disabled", true);
        DataHandler.initial().onSuccess((response) => {
            document.querySelector('.qr-code-field').setAttribute("data-code", response.message.qr_code);
            loadQR();
            btn.removeAttribute("disabled");
        }).onError((error) => {
            HTMLElements.errorPopup(error);
            btn.removeAttribute("disabled");
        }).postRequest(e.target.getAttribute('data-api'), null)
    });

    let qr = null;
    let code = document.querySelector('.qr-code-field');
    let download = document.querySelector(".download");
    let loadQR = () => {
        if(qr !== null) qr.clear();
        code.innerHTML = "";
        qr = new QRCode(code, code.getAttribute("data-code"));
        code.querySelector("img").addEventListener('load', (e) => {
            download.setAttribute("href", e.target.getAttribute("src"));
        });
    };
    loadQR();
}
