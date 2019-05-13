
    var lastEvent;
    var siteModalID = 'siteModal';
    var popupModalID = 'popupModal';
    var popupID = 'popupDialog';
    var cardboardModalID = 'myModal';
    var cardboardID = 'cardboard-body';
    var fadeLength = 200;

    function openAddUserDialog(event) {
        openDialog('Add a user');
        loadSiteIntoElement(popupModalID, popupID, 'api/management/users/add');
    }

    function openDialog(header) {
        document.getElementById('popupDialogHeader').innerHTML = header;
        activateModal(siteModalID);
    }

    function activateModal(modal) {
        console.log("activating modal " + document.getElementById(modal));
        document.getElementById(modal).style.display = "block";
        setTimeout(function() {
            document.getElementById(modal).style.backgroundColor = "rgba(0,0,0,.2)";
        }, fadeLength);
    }

    function deactivateModal(modal) {
        document.getElementById(modal).style.backgroundColor = "rgba(0,0,0,0)";
        setTimeout(() => {
            document.getElementById(modal).style.display = "none";
        }, fadeLength);
    }

    function buildMenuPage(event, pageName) {
        if (lastEvent == null || event.originalTarget != lastEvent.originalTarget) {
            fetchSiteIntoElement(cardboardModalID, cardboardID, 'api/management/' + pageName);
            setLastPressed(event);
        }
    }

    function setLastPressed(event) {
        if (lastEvent != null) {
            console.log('last event exists');
            lastEvent.originalTarget.classList.toggle('selectedMenu');
        }
        lastEvent = event;
        event.originalTarget.classList.toggle('selectedMenu');
    }

    // When the user clicks on <span> (x), close the modal
    function closePopup(event) {
        deactivateModal(siteModalID);
    }

    function loadSiteIntoElement(modal, body, url) {
        console.log('loading ' + url + ' into', body, modal);
        fadeOutElement(body);
        console.log("Button pressed");
        activateModal(modal);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.status != 0) {
                console.log(this.status);
                fadeOutElement(body);
                if (this.readyState == 4 && this.status == 200) {
                    setTimeout(function() {
                        document.getElementById(body).innerHTML = xhttp.responseText;
                    }, fadeLength);
                } else if (this.readyState == 4 && this.status != 0) {
                    setTimeout(function() {
                        if (xhttp.responseText.includes("Whoops! There was an error.")) {
                            document.documentElement.innerHTML = xhttp.responseText;
                        } else {
                            document.getElementById(body).innerHTML = xhttp.responseText;
                        }
                        console.log(xhttp.responseText);
                    }, fadeLength);
                }
                console.log("retrieved content, disabling modal ", document.getElementById(modal));
                deactivateModal(modal);
                setTimeout(function() {
                    fadeInElement(body);
                }, fadeLength);

            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }

    function fetchSiteIntoElement(modal, body, url) {
        console.log('loading ' + url + ' into', body, modal);
        fadeOutElement(body);
        activateModal(modal);
        
        fetch(url).then(function(data) {
            setTimeout(function() {
                fadeOutElement(body);
                data.text().then(function(text) {
                    console.log();
                document.getElementById(body).innerHTML = text;
                });
            }, fadeLength);
            console.log("retrieved content, disabling modal ", document.getElementById(modal));
        deactivateModal(modal);
        setTimeout(function() {
            fadeInElement(body);
        }, fadeLength);
        });
        
        
    }

    function fadeOutElement(element) {
        document.getElementById(element).style.opacity = 0;
    }

    function fadeInElement(element) {
        document.getElementById(element).style.opacity = 1;
    }

    
function hello(){
    console.log("heeeeellllllllllooooooooooooooooooooooooooo");
}

function isAddUserDataValid(){
    var username_input = document.getElementById('username').value;
    var email_input = document.getElementById('email').value;
    var password_input = document.getElementById('password').value;
    var passwordConfirm_input = document.getElementById('password-confirm').value;

    if(password_input == passwordConfirm_input){
         
    }


}