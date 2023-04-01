function ChangedSuggestionBanner(suggestNumber) {
    if(suggestNumber==1) { document.getElementById("Suggestion1").style.borderTopColor = "#2ba3ff"; document.getElementById("Suggestion2").style.borderTopColor = "White"; document.getElementById("Suggestion3").style.borderTopColor = "White"; document.getElementById("Suggestion4").style.borderTopColor = "White";}
    if(suggestNumber==2) { document.getElementById("Suggestion1").style.borderTopColor = "White"; document.getElementById("Suggestion2").style.borderTopColor = "#2ba3ff"; document.getElementById("Suggestion3").style.borderTopColor = "White"; document.getElementById("Suggestion4").style.borderTopColor = "White";}
    if(suggestNumber==3) { document.getElementById("Suggestion1").style.borderTopColor = "White"; document.getElementById("Suggestion2").style.borderTopColor = "White"; document.getElementById("Suggestion3").style.borderTopColor = "#2ba3ff"; document.getElementById("Suggestion4").style.borderTopColor = "White";}
    if(suggestNumber==4) { document.getElementById("Suggestion1").style.borderTopColor = "White"; document.getElementById("Suggestion2").style.borderTopColor = "White"; document.getElementById("Suggestion3").style.borderTopColor = "White"; document.getElementById("Suggestion4").style.borderTopColor = "#2ba3ff";}
}

function AccountMenuOpen() { document.getElementById("accountIconID").focus(); }

function menu() {
    if(document.activeElement === document.getElementById("accountIconID")) 
        document.getElementById("logg").style.left = document.getElementById("accountIconID").getBoundingClientRect().left-170 + "px";
    else document.getElementById("logg").style.left = "999em";
}

addEventListener('resize', (event) => { menu(); });
addEventListener('load', (event) => { menu(); });
addEventListener('click', (event) => { menu(); });

let theNewestProductsDivProductContainer = document.getElementById("theNewestProductsDivProductContainer");
let bestSellersProductsDivProductContainer = document.getElementById("bestSellersProductsDivProductContainer");
let lastWatchedProductsProductContainer = document.getElementById("lastWatchedProductsProductContainer");

function mouseDown() {
    theNewestProductsDivProductContainer.addEventListener("mousemove", getMouseDirection, false);
    bestSellersProductsDivProductContainer.addEventListener("mousemove", getMouseDirection1, false);
    lastWatchedProductsProductContainer.addEventListener("mousemove", getMouseDirection2, false);
}

function mouseUp() {
    theNewestProductsDivProductContainer.removeEventListener("mousemove", getMouseDirection, false);
    bestSellersProductsDivProductContainer.removeEventListener("mousemove", getMouseDirection1, false);
    lastWatchedProductsProductContainer.removeEventListener("mousemove", getMouseDirection2, false);
    countMove = 0;
}

var oldX = 0;
var oldY = 0;
var countMove = 0; 

function getMouseDirection(e) {
    if (oldX < e.pageX) countMove--;
    else countMove++;

    theNewestProductsDivProductContainer.scrollLeft += countMove/15;
    oldX = e.pageX;
    oldY = e.pageY;
}

function getMouseDirection1(e) {
    if (oldX < e.pageX) countMove--;
    else countMove++;

    bestSellersProductsDivProductContainer.scrollLeft += countMove/15;
    oldX = e.pageX;
    oldY = e.pageY;

}

function getMouseDirection2(e) {
    if (oldX < e.pageX) countMove--;
    else countMove++;

    lastWatchedProductsProductContainer.scrollLeft += countMove/15;
    oldX = e.pageX;
    oldY = e.pageY;

}


theNewestProductsDivProductContainer.addEventListener('mousedown', mouseDown);
theNewestProductsDivProductContainer.addEventListener('mouseup', mouseUp);

bestSellersProductsDivProductContainer.addEventListener('mousedown', mouseDown);
bestSellersProductsDivProductContainer.addEventListener('mouseup', mouseUp);

lastWatchedProductsProductContainer.addEventListener('mousedown', mouseDown);
lastWatchedProductsProductContainer.addEventListener('mouseup', mouseUp);