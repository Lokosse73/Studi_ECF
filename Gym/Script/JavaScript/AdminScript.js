    const cName = document.querySelectorAll('.ClientName');
    const cActive = document.querySelectorAll('.ClientActive');

window.onload = function(){
    const cName = document.querySelectorAll('.ClientName');
    const cId = document.querySelectorAll('.ClientId');
    const sName = document.querySelectorAll('.OwnerName');
    const sId = document.querySelectorAll('.StructureId');

    const Client_Name_Search = document.getElementById('NameSearch');
    const Client_Id_Search = document.getElementById('IdSearch');
    const Struct_Name_Search = document.getElementById('StructureNameSearch');
    const Struct_Id_Search = document.getElementById('StructureIdSearch');
    let IdisSearch = false;
    let IdisSearchStruct = false;


//client search
    const inputHandlerName = function(e) {
        if(IdisSearch === false){
            HideAndSeek(e.target.value, cName);
        }
    }

    const inputHandlerId = function(e) {
        if(e.target.value === ""){
            IdisSearch = false;
            Client_Name_Search.classList.remove("redInactive");
            HideAndSeek(Client_Name_Search.value, cName);
        }else{
            IdisSearch = true;
            Client_Name_Search.classList.add("redInactive");
            HideAndSeek(e.target.value, cId);
        }
    }

    Client_Name_Search.addEventListener('input', inputHandlerName);
    Client_Name_Search.addEventListener('propertychange', inputHandlerName);


    Client_Id_Search.addEventListener('input', inputHandlerId);
    Client_Id_Search.addEventListener('propertychange', inputHandlerId);



//structure search
    const inputHandlerNameStruct = function(e) {
        if(IdisSearchStruct === false){
            HideAndSeekStruct(e.target.value, sName);
        }
    }

    const inputHandlerIdStruct = function(e) {
        if(e.target.value === ""){
            IdisSearchStruct = false;
            Struct_Name_Search.classList.remove("redInactive");
            HideAndSeekStruct(Struct_Name_Search.value, sName);
        }else{
            IdisSearchStruct = true;
            Struct_Name_Search.classList.add("redInactive");
            HideAndSeekStruct(e.target.value, sId);
        }
    }

    Struct_Name_Search.addEventListener('input', inputHandlerNameStruct);
    Struct_Name_Search.addEventListener('propertychange', inputHandlerNameStruct);

    Struct_Id_Search.addEventListener('input', inputHandlerIdStruct);
    Struct_Id_Search.addEventListener('propertychange', inputHandlerIdStruct);
}

let ActiveFilter = false;
let InActiveFilter = false;
let idselected = 0; // on go to struct page

function HideAndSeek(Search, SearchIn){
    let i = 0;
    while(SearchIn.length-1 >= i){
        const regex = new RegExp(Search, "i");
        //console.log(cName[i].innerHTML.match(regex));
        if(SearchIn[i].innerHTML.match(regex)){
            SearchIn[i].parentElement.parentElement.parentElement.parentElement.classList.add("visible");
            SearchIn[i].parentElement.parentElement.parentElement.parentElement.classList.remove("hidden");
            if((ActiveFilter && cActive[i].value !== "Actif") || (InActiveFilter && cActive[i].value === "Actif")){
                cActive[i].parentElement.parentElement.parentElement.parentElement.classList.add("hidden");
                cActive[i].parentElement.parentElement.parentElement.parentElement.classList.remove("visible");
            }
        }else{
            SearchIn[i].parentElement.parentElement.parentElement.parentElement.classList.add("hidden");
            SearchIn[i].parentElement.parentElement.parentElement.parentElement.classList.remove("visible");
        }
        i++;
    }
}

function HideAndSeekStruct(Search, SearchIn){
    let i = 0;
    const h = document.querySelectorAll('.client_idForStruct'); //struct id
    while(SearchIn.length-1 >= i){
        const regex = new RegExp(Search, "i");
        //console.log(cName[i].innerHTML.match(regex));
        if(SearchIn[i].innerHTML.match(regex) && h[i].value === idselected){
            SearchIn[i].parentElement.parentElement.parentElement.parentElement.classList.add("visible");
            SearchIn[i].parentElement.parentElement.parentElement.parentElement.classList.remove("hidden");
        }else{
            SearchIn[i].parentElement.parentElement.parentElement.parentElement.classList.add("hidden");
            SearchIn[i].parentElement.parentElement.parentElement.parentElement.classList.remove("visible");
        }
        i++;
    }
}

function ClickActif(){
    InActiveFilter = false;
    ActiveFilter = true;
    const Client_Name_Search = document.getElementById('NameSearch');
    HideAndSeek(Client_Name_Search.value, cName);
}
function ClickNonActif(){
    ActiveFilter = false;
    InActiveFilter = true;
    const Client_Name_Search = document.getElementById('NameSearch');
    HideAndSeek(Client_Name_Search.value, cName);
}
function ClickTous(){
    ActiveFilter = false;
    InActiveFilter = false;
    const Client_Name_Search = document.getElementById('NameSearch');
    HideAndSeek(Client_Name_Search.value, cName);
}

function ChowElement(Element){
    var Screen = document.getElementById(Element);
    Screen.classList.add("visible");
    Screen.classList.remove("hidden");
}
function HiddeElement(Element){
    var Screen = document.getElementById(Element);
    Screen.classList.add("hidden");
    Screen.classList.remove("visible");
}
function ReturnPartner(){
    var Screen = document.getElementById("StructurePanel");
    Screen.classList.add("hidden");
    Screen.classList.remove("visible");

    Screen = document.getElementById("PartnerPanel");
    Screen.classList.add("visible");
    Screen.classList.remove("hidden");
}
function runStructure(id){
    const cIdS = document.querySelectorAll('.ClientIdInStructure');
    let i = 0;
    idselected = id;
    while(cIdS.length-1 >= i){
        if(cIdS[i].innerHTML === id){
            cIdS[i].parentElement.parentElement.parentElement.parentElement.parentElement.classList.add("visible");
            cIdS[i].parentElement.parentElement.parentElement.parentElement.parentElement.classList.remove("hidden");
        }
        else{
            cIdS[i].parentElement.parentElement.parentElement.parentElement.parentElement.classList.add("hidden");
            cIdS[i].parentElement.parentElement.parentElement.parentElement.parentElement.classList.remove("visible");
        }
        i++;
    }
    const sIDS = document.querySelectorAll('.client_idForStruct');
    let j = 0;
    while(sIDS.length-1 >= j){
        if(sIDS[j].value === id){
            sIDS[j].parentElement.parentElement.parentElement.parentElement.classList.add("visible");
            sIDS[j].parentElement.parentElement.parentElement.parentElement.classList.remove("hidden");
        }
        else{
            sIDS[j].parentElement.parentElement.parentElement.parentElement.classList.add("hidden");
            sIDS[j].parentElement.parentElement.parentElement.parentElement.classList.remove("visible");
        }
        j++;
    }

    var Screen = document.getElementById("StructurePanel");
    Screen.classList.add("visible");
    Screen.classList.remove("hidden");

    Screen = document.getElementById("PartnerPanel");
    Screen.classList.add("hidden");
    Screen.classList.remove("visible");

    var idvalue = document.getElementById('AddStructId');
    idvalue.value = id;
}

function Copy(Element) {
    // Get the text field
    var copyText = document.getElementById(Element);

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
}