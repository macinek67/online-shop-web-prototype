function MainPageGoToCartFunction() {
    window.location="cart/index.php";
}

function MainPageGoToFavoritesFunction() {
    window.location="favorites/index.php";
}

let baner = document.getElementById("SuggestionsBanerID");

function ChangedSuggestionBanner(suggestNumber) {
    if(suggestNumber==1) { baner.style.backgroundImage = "url('../images/freeShipBackground.jpg')"; document.getElementById("Suggestion1").style.borderTopColor = "#2ba3ff"; document.getElementById("Suggestion2").style.borderTopColor = "White"; document.getElementById("Suggestion3").style.borderTopColor = "White"; document.getElementById("Suggestion4").style.borderTopColor = "White";}
    if(suggestNumber==2) { baner.style.backgroundImage = "url('../images/monety.png')"; document.getElementById("Suggestion1").style.borderTopColor = "White"; document.getElementById("Suggestion2").style.borderTopColor = "#2ba3ff"; document.getElementById("Suggestion3").style.borderTopColor = "White"; document.getElementById("Suggestion4").style.borderTopColor = "White";}
    if(suggestNumber==3) { baner.style.backgroundImage = "url('../images/okazje.png')"; document.getElementById("Suggestion1").style.borderTopColor = "White"; document.getElementById("Suggestion2").style.borderTopColor = "White"; document.getElementById("Suggestion3").style.borderTopColor = "#2ba3ff"; document.getElementById("Suggestion4").style.borderTopColor = "White";}
    if(suggestNumber==4) { baner.style.backgroundImage = "url('../images/newsletterBaner1.png')"; document.getElementById("Suggestion1").style.borderTopColor = "White"; document.getElementById("Suggestion2").style.borderTopColor = "White"; document.getElementById("Suggestion3").style.borderTopColor = "White"; document.getElementById("Suggestion4").style.borderTopColor = "#2ba3ff";}
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

var searchBar = document.getElementById("searchBarId");
var searchBarSubmit = document.getElementById("SearchButtonSubmit");
let searchBarForm = document.getElementById("searchBarFormId");
let categorySelectId = document.getElementById("headerDivCategorySelectId");

searchBarSubmit.addEventListener("click", function(event) {
    searchBarForm.elements[0].value = searchBar.value;
    searchBarForm.elements[1].value = categorySelectId.value;
    searchBarForm.submit();
});

theNewestProductsDivProductContainer.addEventListener('mousedown', mouseDown);
theNewestProductsDivProductContainer.addEventListener('mouseup', mouseUp);

bestSellersProductsDivProductContainer.addEventListener('mousedown', mouseDown);
bestSellersProductsDivProductContainer.addEventListener('mouseup', mouseUp);

lastWatchedProductsProductContainer.addEventListener('mousedown', mouseDown);
lastWatchedProductsProductContainer.addEventListener('mouseup', mouseUp);