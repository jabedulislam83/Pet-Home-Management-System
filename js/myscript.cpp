function formValidation(){
    if(checkQuantity()) {
        return true;
    } else {
        return false;
    }
}

function checkQuantity(){
    var quantity = document.getElementById("quantity").value;
    if(quantity == "" || isNaN(quantity)){
        document.getElementById("quantityError").innerHTML = "Must be a valid number";
        return false;
    } else {
        return true;
    }
}

function searchOrder(){
    var order = document.getElementById("search").value;
    console.log(order);
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById("show").innerHTML = this.responseText;
        }
    };

    xhr.open("GET", "../control/ajaxrequest.php?search=" + order, true);
    xhr.send();
}