
    var lastEvent;
    var lastClickedServer;
    var siteModalID = 'siteModal';
    var popupModalID = 'popupModal';
    var popupID = 'popupDialog';
    var cardboardModalID = 'myModal';
    var cardboardID = 'cardboard-body';
    var fadeLength = 200;
    var currentServerID;

    function openAddUserDialog(event) {
        openDialog('Add a user');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/users/add');
    }

    function openDialog(header) {
        document.getElementById('popupDialogHeader').innerHTML = header;
        activateModal(siteModalID);
    }

    function activateModal(modal) {
        ("activating modal " + document.getElementById(modal));
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
            ('last event exists');
            lastEvent.originalTarget.classList.toggle('selectedMenu');
        }
        lastEvent = event;
        event.originalTarget.classList.toggle('selectedMenu');
    }

    // When the user clicks on <span> (x), close the modal
    function closePopup(event) {
        deactivateModal(siteModalID);
    }

    function getUsername(){
        return document.getElementById("navbarDropdown").getAttribute("username"); 
    }

    function fetchSiteIntoElement(modal, body, url){
        fetchSiteIntoElement(modal, body, url, null, null);
    }

    function sendSSHCommand(action){
        fetchSiteIntoElement('actions-modal', 'actions-body', 'api/dashboard/ssh/'+currentServerID+'/action/'+action, '<pre>', '</pre>');
    }

    function fetchSiteIntoElement(modal, body, url, startContentWrapper, endContentWrapper) {
        var useWrapping;
        if(startContentWrapper != null && endContentWrapper != null){
            useWrapping = true;
        }
        var username = getUsername();
        ('loading ' + url + ' into', body, modal);
        fadeOutElement(body);
        activateModal(modal);
        var data = {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({username: username})
          };
        fetch(url, data).then(function(data) {
            setTimeout(function() {
                fadeOutElement(body);
                data.text().then(function(text) {
                    if(useWrapping){
                        document.getElementById(body).innerHTML = startContentWrapper+text+endContentWrapper;
                    } else {
                        document.getElementById(body).innerHTML = text;
                    }
                });
            }, fadeLength);
            ("retrieved content, disabling modal ", document.getElementById(modal));
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
    ("heeeeellllllllllooooooooooooooooooooooooooo");
}

function collapseCollapsible(event) {
    console.log('collapsing');
    event.originalTarget.classList.toggle('active');
    var content = event.originalTarget.nextElementSibling;
    content.classList.toggle('closedCollapsible');
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
    }
}

function onClickServer(event){
    window.clearInterval();
    collapseCollapsible(event);
    if(lastClickedServer == null || lastClickedServer != event.originalTarget){
        lastClickedServer = event.originalTarget;
        var serverID = getServerIDFromServerCard(event);
        fetchSiteIntoElement(cardboardModalID, cardboardID, 'api/dashboard/server/'+serverID);
    }
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

function onClickGetStatus(event){
    window.setInterval(function(){
        console.log("I call for server Status on ServerID "+lastClickedServer);
        fetchSiteIntoElement('status-modal', 'status-body', 'api/dashboard/ssh/'+currentServerID+'/status', '<pre>', '</pre>');;
    }, 20000);
    fetchSiteIntoElement('status-modal', 'status-body', 'api/dashboard/ssh/'+currentServerID+'/status', '<pre>', '</pre>');
}

function onClickStartServer(){
    sendSSHCommand('start');

}
function onClickStopServer(){
    sendSSHCommand('stop');
}
function onClickRestartServer(){
    sendSSHCommand('restart');
}
function onClickUpdateServer(){
    sendSSHCommand('update');
}

function getStatusOverSSH(){
    var username = getUsername();
    var data = {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({username: username})
      };
    fetch('api/dashboard/ssh/'+currentServerID+'/status', data).then(function(response) {
        response.text().then(function(text){
            document.getElementById('status-body').innerHTML = '<pre>'+text+'</pre>' ;
        })
    })
}

function onClickInspectGroup(event){
    var selected= (event.originalTarget);
    var selectedGroupName = selected.innerHTML;
    fetchSiteIntoElement('group-inspect-modal', 'group-inspect-body', 'api/management/groups/'+selectedGroupName+'/inspect');
}

