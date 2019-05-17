
    var lastEvent;
    var lastClickedServer;
    var siteModalID = 'siteModal';
    var popupModalID = 'popupModal';
    var popupID = 'popupDialog';
    var cardboardModalID = 'cardboardModal';
    var cardboardID = 'cardboard-body';
    var fadeLength = 200;
    var currentServerID;
    var intervall;

    function openAddUserDialog(event) {
        openDialog('Add a user');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/users/addDialog');
    }
    function openEditUserDialog(event) {
        openDialog('Edit a user');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/users/editDialog');
    }
    function openDeleteUserDialog(event) {
        openDialog('Delete a user');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/users/deleteDialog');
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
        var username = getUsername();
        var json = JSON.stringify({loggedUsername: username});
        makeAjaxCall(modal, body, url, json, startContentWrapper, endContentWrapper);
    }

    function makeAjaxCall(modal, body, url, json, expectJsonResponse){
        makeAjaxCall(modal, body, url, json, null, null);
    }

    function makeAjaxCall(modal, body, url, json, expectJsonResponse, startContentWrapper, endContentWrapper) {
        var useWrapping;
        if(startContentWrapper != null && endContentWrapper != null){
            useWrapping = true;
        }
        ('loading ' + url + ' into', body, modal);
        fadeOutElement(body);
        activateModal(modal);
        var data = {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: json
          };
        fetch(url, data).then(function(data) {
            setTimeout(function() {
                fadeOutElement(body);
                data.text().then(function(text) {
                    console.log(text);
                    if(expectJsonResponse){
                        var response = JSON.parse(text);
                        text = response.message;
                    } 
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
    if(intervall != null){
        window.clearInterval(intervall);
    }
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
    intervall = window.setInterval(function(){
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
        body: JSON.stringify({loggedUsername: username})
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

function onClickSubmitAddUser(event){
    if(passwordCaptchaValid()){
        var currentUsername = getUsername();
        var newUsername = document.getElementById('username').value;
        var newEmail= document.getElementById('email').value;
        var newPassword= document.getElementById('password').value;
        var json = JSON.stringify({loggedUsername: currentUsername, username: newUsername, email: newEmail, password: newPassword});
        makeAjaxCall('popupModal', 'popupDialog', 'api/management/users/action/add', json, true);
    } else {
        document.getElementById('submitError').innerHTML = 'Passwords did not match';
    }
}

function onClickSubmitEditUser(event){
    if(passwordCaptchaValid()){
        var currentUsername = getUsername();
        var selector = document.getElementById('user_id_selector');
        var editUser_id = selector.options[selector.selectedIndex].value;
        var editUsername = document.getElementById('username').value;
        var editEmail= document.getElementById('email').value;
        var editPassword= document.getElementById('password').value;
        var json = JSON.stringify({loggedUsername: currentUsername, username: editUsername, email: editEmail, password: editPassword, user_id: editUser_id});
        makeAjaxCall('popupModal', 'popupDialog', 'api/management/users/action/edit', json, true);
    } else {
        document.getElementById('submitError').innerHTML = 'Passwords did not match';
    }
}

function onClickSubmitDeleteUser(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('user_id_selector');
    var deleteUser_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({loggedUsername: currentUsername, user_id: deleteUser_id});
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/users/action/delete', json, true);
}

function passwordCaptchaValid(){
    var valPass1 = document.getElementById('password').value;
    var valPass2 = document.getElementById('password-confirm').value;
    if(valPass1 != "" && valPass2 != ""){
        return (valPass1 == valPass2);
    } 
    return false;
}