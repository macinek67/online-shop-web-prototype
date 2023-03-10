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