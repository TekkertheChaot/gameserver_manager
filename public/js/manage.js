
    var lastEvent;
    var siteModalID = 'siteModal';
    var popupModalID = 'popupModal';
    var popupID = 'popupDialog';
    var cardboardModalID = 'myModal';
    var cardboardID = 'cardboard-body';
    var fadeLength = 200;
    var currentServerID;

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
    function onCLickManageMenuItem(event, pageName){
        buildMenuPage(event, pageName);
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

function collapseCollapsible(event) {
    event.originalTarget.classList.toggle('active');
    var content = event.originalTarget.nextElementSibling;
    content.classList.toggle('closedCollapsible');
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
    } else {
        content.style.maxHeight = content.scrollHeight + "px";
    }
}

function onClickServer(event){
    collapseCollapsible(event);
    var serverID = getServerIDFromServerCard(event);
    fetchSiteIntoElement(cardboardModalID, cardboardID, 'api/dashboard/server/'+serverID);
}

function getServerIDFromServerCard(event){

    return currentServerID = event.originalTarget.offsetParent.id.replace('server_','');
}

function isAddUserDataValid(){
    var username_input = document.getElementById('username').value;
    var email_input = document.getElementById('email').value;
    var password_input = document.getElementById('password').value;
    var passwordConfirm_input = document.getElementById('password-confirm').value;

    if(password_input == passwordConfirm_input){
         
    }
}
// TODO

function doSSHtest() {
    var data = document.getElementById('sshfield').value;
    console.log("Button pressed");
    var params = typeof data == 'string' ? data : Object.keys(data).map(
        function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }
    ).join('&');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("console-output").innerHTML = this.responseText;
            console.log(this.responseText);
        } else {
            console.log(this.status);
        }
    };
    xhttp.open("POST", "api/ssh/APItest");
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send(params);
}

function onClickRunSSH(event){
    var cmd = document.getElementById('cmd').value;
    data = {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ cmd: cmd})
      };
    fetch('api/dashboard/ssh/'+currentServerID+"/"+cmd, data).then(function(response) {
        response.text().then(function(text){
            document.getElementById('console-body').innerHTML = '<pre>'+text+'</pre>' ;
        })
    })
}