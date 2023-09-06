var shoppingCartList = new  Array();

class Produs
{
    constructor(id, cantitate)
    {
        this.id = id;
        this.cantitate = cantitate;
    }
}

function adauga_produs_button(item)
{
    item.classList.add("animate");
    setTimeout(function(){
        item.classList.remove("animate");
    }, 500);

    var id_produs = item.getAttribute('data-id');

    adauga_produs(id_produs, 1);

}

function adauga_produs(id_produs, quantity)
{
    var existaProdus = false;
    for (produs of shoppingCartList)
    {
        if(produs.id == id_produs)
        {            
            produs.cantitate += quantity;
            existaProdus = true;
        }
    }

    if(!existaProdus)
    {
        var produs_nou = new Produs(id_produs, 1);
        shoppingCartList.push(produs_nou);
    }


    eraseCookie("shoppingCart");
    createCookie("shoppingCart", JSON.stringify(shoppingCartList), 1);

    update_vizual_cos();    
}

function sterge_produs_button(item)
{
    var id_produs = item.getAttribute('data-id');
    sterge_produs(id_produs);
}

function sterge_produs(id_produs)
{
    var index = -1;

    for (i = 0; i < shoppingCartList.length; i++)
    {
        if (shoppingCartList[i].id == id_produs)
        {
            index = i;
            break;
        }
    }

    if (index > -1)
    {
        shoppingCartList.splice(index, 1);
    }

    eraseCookie("shoppingCart");
    createCookie("shoppingCart", JSON.stringify(shoppingCartList), 1);

    location.reload();

    update_vizual_cos();
}

function incarca_cos()
{
    var cartContentString = readCookie("shoppingCart");
    if(cartContentString != null)
        shoppingCartList = JSON.parse(readCookie("shoppingCart"));
}

function update_vizual_cos()
{
    var cartContentString = readCookie("shoppingCart");
    if(cartContentString != null)
        shoppingCartList = JSON.parse(readCookie("shoppingCart"));

    var shoppingCartItemNo = document.getElementById("shoppingCartItemNo");

    if(shoppingCartList.length > 0)
    {
        shoppingCartItemNo.innerHTML = shoppingCartList.length;
        shoppingCartItemNo.style.display = "block";
    }
    else
    {
        shoppingCartItemNo.style.display = "none";
    }
}

window.onload = (event) => { 
    update_vizual_cos() 
    var page = (window.location.pathname).split("/").pop();
    if(page == "cos.php")
    {
        if (shoppingCartList.length == 0)
        {
            var bt = document.getElementById("comandaBT");
            bt.disabled = true;
            bt.classList.add("disabled");
        }
    }


    var notif = document.getElementById("notificare");
    if(notif != null)
    {
        setTimeout(function(){
            notif.style.display = "none";
            remove(item);
        }, 1500);
    }
};

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function quantityChange(input)
{
    var newQuantity = input.value;
    var id_produs = input.getAttribute('data-id');
    var oldQuantity = input.oldValue;

    adauga_produs(id_produs, newQuantity-oldQuantity);    
    location.reload();
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}



