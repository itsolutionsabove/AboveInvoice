export class HTMLElements{

    static popup(message, success = true){
        alert(message);
    }

    static successPopup(message){
        this.popup(message);
    }

    static errorPopup(message){
        this.popup(message, false);
    }

    static preLoader(){
        return '<div class="animated-background"><div class="background-masker btn-divide-left"></div></div>';
    }

    static tableTR(columns){
        return "<tr>" + columns + "</tr>";
    }

    static tableTD(value, center = true, colspan = false){
        return "<td " + (center ? "class=' text-left' " : "") + (colspan ? "colspan='" + colspan + "'" : "") +
            "><span class='text-secondary font-weight-bold'>" + value + "</span></td>";
    }

    static a(classes, href, text){
        return "<a href='" + href + "' class='" + classes + "'>" + text + "</a>";
    }

    static showIcon(){
        return 'Manage';
    }

    static deleteIcon(){
        return 'Delete';
    }

    static moveUpIcon(){
        return '<i class="fa fa-arrow-up"></i>';
    }

    static moveDownIcon(){
        return '<i class="fa fa-arrow-down"></i>';
    }

}
