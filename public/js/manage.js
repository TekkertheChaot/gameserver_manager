
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
    var currentMenu;

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
    function openAddGroupDialog(event) {
        openDialog('Add a group');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/groups/addDialog');
    }
    function openEditGroupDialog(event) {
        openDialog('Edit a group');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/groups/editDialog');
    }
    function openDeleteGroupDialog(event) {
        openDialog('Delete a group');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/groups/deleteDialog');
    }
    function openAddUserToGroupDialog(event) {
        openDialog('Add user to group');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/groups/addUserDialog');
    }
    function openDeleteUserFromGroupDialog(event) {
        openDialog('Remove user from group');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/groups/removeUserDialog');
    }
    function openAddHostDialog(event) {
        openDialog('Add a Host');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/hosts/addDialog');
    }
    function openEditHostDialog(event) {
        openDialog('Edit a Host');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/hosts/editDialog');
    }
    function openDeleteHostDialog(event) {
        openDialog('Delete a Host');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/hosts/deleteDialog');
    }
    function openAddCredDialog(event) {
        openDialog('Add Credentials');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/creds/addDialog');
    }
    function openEditCredDialog(event) {
        openDialog('Edit Credentials');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/creds/editDialog');
    }
    function openDeleteCredDialog(event) {
        openDialog('Delete Credentials');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/creds/deleteDialog');
    }
    function openAddGameDialog(event) {
        openDialog('Add Game');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/games/addDialog');
    }
    function openEditGameDialog(event) {
        openDialog('Edit Game');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/games/editDialog');
    }
    function openDeleteGameDialog(event) {
        openDialog('Delete Game');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/games/deleteDialog');
    }
    function openAddServerDialog(event) {
        openDialog('Add Server');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/servers/addDialog');
    }
    function openEditServerDialog(event) {
        openDialog('Edit Server');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/servers/editDialog');
    }
    function openDeleteServerDialog(event) {
        openDialog('Delete Server');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/servers/deleteDialog');
    }
    function openAddUserPrivDialog(event) {
        openDialog('Add User Privileges');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/userPrivs/addDialog');
    }
    function openEditUserPrivDialog(event) {
        openDialog('Edit User Privileges');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/userPrivs/editDialog');
    }
    function openDeleteUserPrivDialog(event) {
        openDialog('Delete User Privileges');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/userPrivs/deleteDialog');
    }
    function openAddGroupPrivDialog(event) {
        openDialog('Add Group Privileges');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/groupPrivs/addDialog');
    }
    function openEditGroupPrivDialog(event) {
        openDialog('Edit Group Privileges');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/groupPrivs/editDialog');
    }
    function openDeleteGroupPrivDialog(event) {
        openDialog('Delete Group Privileges');
        fetchSiteIntoElement(popupModalID, popupID, 'api/management/groupPrivs/deleteDialog');
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
            currentMenu = pageName;
            loadMenuPage(pageName);
            setLastPressed(event);
        }
    }

    function reloadMenuPage(){
        if(currentMenu != null){
        loadMenuPage(currentMenu);
        }
    }
    function loadMenuPage(pageName){
        fetchSiteIntoElement(cardboardModalID, cardboardID, 'api/management/' + pageName);
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
        makeAjaxCall(modal, body, url, json, false, startContentWrapper, endContentWrapper);
    }

    function makeAjaxCall(modal, body, url, json, expectJsonResponse){
        makeAjaxCall(modal, body, url, json, expectJsonResponse,null, null);
    }

    function makeAjaxCall(modal, body, url, json, expectJsonResponse, startContentWrapper, endContentWrapper) {
        console.log('modal: '+modal+' body: '+body+' url: '+url+' json: '+json+' expectJsonResponse: '+expectJsonResponse+' startContentWrapper: '+ startContentWrapper+' endContentWrapper: '+endContentWrapper    );
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
                        if(response.ok == 1){
                            reloadMenuPage();
                        }
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

function onClickGetStatus(event){
    intervall = window.setInterval(function(){
        fetchSiteIntoElement('status-modal', 'status-body', 'api/dashboard/ssh/'+currentServerID+'/status','<pre>', '</pre>');
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

function passwordCaptchaValid(){
    var valPass1 = document.getElementById('password').value;
    var valPass2 = document.getElementById('password-confirm').value;
    if(valPass1 != "" && valPass2 != ""){
        return (valPass1 == valPass2);
    } 
    return false;
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
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        user_id: deleteUser_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/users/action/delete', json, true);
}

function onClickSubmitAddGroup(event){
        var currentUsername = getUsername();
        var groupname = document.getElementById('group_name').value;
        var json = JSON.stringify({
            loggedUsername: currentUsername, 
            group_name: groupname
        });
        makeAjaxCall('popupModal', 'popupDialog', 'api/management/groups/action/add', json, true);
}

function onClickSubmitEditGroup(event){
        var currentUsername = getUsername();
        var selector = document.getElementById('group_id_selector');
        var editGroup_id = selector.options[selector.selectedIndex].value;
        var editGroupname = document.getElementById('group_name').value;
        var json = JSON.stringify({
            loggedUsername: currentUsername, 
            group_name: editGroupname, 
            group_id: editGroup_id
        });
        makeAjaxCall('popupModal', 'popupDialog', 'api/management/groups/action/edit', json, true);
}

function onClickSubmitDeleteGroup(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('group_id_selector');
    var deleteGroup_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        group_id: deleteGroup_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/groups/action/delete', json, true);
}




function onClickSubmitAddUserToGroup(event){
    var currentUsername = getUsername();
    var groupSelector = document.getElementById('group_id_selector');
    var group_id = groupSelector.options[groupSelector.selectedIndex].value;
    var userSelector = document.getElementById('user_id_selector');
    var user_id = userSelector.options[userSelector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        user_id: user_id, 
        group_id: group_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/groups/action/addUser', json, true);
}

function onClickSubmitDeleteUserFromGroup(event){
    var currentUsername = getUsername();
    var groupSelector = document.getElementById('group_id_selector');
    var group_id = groupSelector.options[groupSelector.selectedIndex].value;
    var userSelector = document.getElementById('user_id_selector');
    var user_id = userSelector.options[userSelector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        user_id: user_id, 
        group_id: group_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/groups/action/deleteUser', json, true);
}

function onClickSubmitAddHost(event){
    var currentUsername = getUsername();
    var ip_adress = document.getElementById('ip_adress').value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        ip_adress: ip_adress
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/hosts/action/add', json, true);
}

function onClickSubmitEditHost(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('host_id_selector');
    var editHost_id = selector.options[selector.selectedIndex].value;
    var editIp_adress = document.getElementById('ip_adress').value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        ip_adress: editIp_adress, 
        host_id: editHost_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/hosts/action/edit', json, true);
}

function onClickSubmitDeleteHost(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('host_id_selector');
    var deleteHost_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        host_id: deleteHost_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/hosts/action/delete', json, true);
}

function onClickSubmitAddCred(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('host_id_selector');
    var host_id = selector.options[selector.selectedIndex].value
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        host_id: host_id, 
        username: username, 
        password: password
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/creds/action/add', json, true);
}

function onClickSubmitEditCred(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('host_id_selector');
    var host_id = selector.options[selector.selectedIndex].value
    selector = document.getElementById('cred_id_selector');
    var cred_id = selector.options[selector.selectedIndex].value
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        host_id: host_id, 
        username: username, 
        password: password, 
        cred_id: cred_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/creds/action/edit', json, true);
}

function onClickSubmitDeleteCred(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('cred_id_selector');
    var deleteCred_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        cred_id: deleteCred_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/creds/action/delete', json, true);
}

function onClickSubmitAddGame(event){
    var currentUsername = getUsername();
    var game_name = document.getElementById('game_name').value;
    var game_label = document.getElementById('game_label').value;
    var rcon = document.getElementById('support_rcon').checked;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        game_label: game_label, 
        game_name: game_name, 
        rcon: rcon
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/games/action/add', json, true);
}

function onClickSubmitEditGame(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('game_id_selector');
    var game_id = selector.options[selector.selectedIndex].value;
    var game_name = document.getElementById('game_name').value;
    var game_label = document.getElementById('game_label').value;
    var rcon = document.getElementById('support_rcon').checked;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        game_id: game_id, 
        game_name: game_name, 
        game_label: game_label,
        rcon: rcon
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/games/action/edit', json, true);
}

function onClickSubmitDeleteGame(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('game_id_selector');
    var game_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        game_id: game_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/games/action/delete', json, true);
}

function onClickSubmitAddServer(event){
    var currentUsername = getUsername();
    var server_name = document.getElementById('server_name').value;
    var server_label = document.getElementById('server_label').value;
    var selector = document.getElementById('game_id_selector');
    var game_id = selector.options[selector.selectedIndex].value;
    selector = document.getElementById('host_id_selector');
    var host_id = selector.options[selector.selectedIndex].value;
    selector = document.getElementById('cred_id_selector');
    var cred_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername,
        server_name: server_name, 
        server_label: server_label, 
        game_id: game_id, 
        host_id: host_id, 
        cred_id: cred_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/servers/action/add', json, true);
}

function onClickSubmitEditServer(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('server_id_selector');
    var server_id = selector.options[selector.selectedIndex].value;
    var server_name = document.getElementById('server_name').value;
    var server_label = document.getElementById('server_label').value;
    selector = document.getElementById('game_id_selector');
    var game_id = selector.options[selector.selectedIndex].value;
    selector = document.getElementById('host_id_selector');
    var host_id = selector.options[selector.selectedIndex].value;
    selector = document.getElementById('cred_id_selector');
    var cred_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        server_id: server_id, 
        server_name: server_name, 
        server_label: server_label, 
        game_id: game_id, 
        host_id: host_id, 
        cred_id: cred_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/servers/action/edit', json, true);
}

function onClickSubmitDeleteServer(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('server_id_selector');
    var server_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        server_id: server_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/servers/action/delete', json, true);
}

function onClickSubmitAddGroupPriv(event){
    var currentUsername = getUsername();
    var lgsm_start = document.getElementById('lgsm_start').checked;
    var lgsm_restart = document.getElementById('lgsm_restart').checked;
    var lgsm_stop = document.getElementById('lgsm_stop').checked;
    var lgsm_update = document.getElementById('lgsm_update').checked;
    var lgsm_status = document.getElementById('lgsm_status').checked;
    var view_in_dash = document.getElementById('view_in_dash').checked;
    var selector = document.getElementById('group_id_selector');
    var group_id = selector.options[selector.selectedIndex].value;
    selector = document.getElementById('server_id_selector');
    var server_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername,
        lgsm_start: lgsm_start, 
        lgsm_restart: lgsm_restart, 
        lgsm_stop: lgsm_stop, 
        lgsm_update: lgsm_update, 
        lgsm_status: lgsm_status,
        view_in_dash: view_in_dash,
        group_id: group_id,
        server_id: server_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/groupPrivs/action/add', json, true);
}

function onClickSubmitEditGroupPriv(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('priv_id_selector');
    var priv_id = selector.options[selector.selectedIndex].value;
    var lgsm_start = document.getElementById('lgsm_start').checked;
    var lgsm_restart = document.getElementById('lgsm_restart').checked;
    var lgsm_stop = document.getElementById('lgsm_stop').checked;
    var lgsm_update = document.getElementById('lgsm_update').checked;
    var lgsm_status = document.getElementById('lgsm_status').checked;
    var view_in_dash = document.getElementById('view_in_dash').checked;
    selector = document.getElementById('group_id_selector');
    var group_id = selector.options[selector.selectedIndex].value;
    selector = document.getElementById('server_id_selector');
    var server_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        lgsm_start: lgsm_start, 
        lgsm_restart: lgsm_restart, 
        lgsm_stop: lgsm_stop, 
        lgsm_update: lgsm_update, 
        lgsm_status: lgsm_status,
        view_in_dash: view_in_dash,
        group_id: group_id,
        server_id: server_id,
        priv_id: priv_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/groupPrivs/action/edit', json, true);
}

function onClickSubmitDeleteGroupPriv(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('priv_id_selector');
    var priv_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        priv_id: priv_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/groupPrivs/action/delete', json, true);
}

function onClickSubmitAddUserPriv(event){
    var currentUsername = getUsername();
    var lgsm_start = document.getElementById('lgsm_start').checked;
    var lgsm_restart = document.getElementById('lgsm_restart').checked;
    var lgsm_stop = document.getElementById('lgsm_stop').checked;
    var lgsm_update = document.getElementById('lgsm_update').checked;
    var lgsm_status = document.getElementById('lgsm_status').checked;
    var view_in_dash = document.getElementById('view_in_dash').checked;
    var selector = document.getElementById('user_id_selector');
    var user_id = selector.options[selector.selectedIndex].value;
    selector = document.getElementById('server_id_selector');
    var server_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername,
        lgsm_start: lgsm_start, 
        lgsm_restart: lgsm_restart, 
        lgsm_stop: lgsm_stop, 
        lgsm_update: lgsm_update, 
        lgsm_status: lgsm_status,
        view_in_dash: view_in_dash,
        user_id: user_id,
        server_id: server_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/userPrivs/action/add', json, true);
}

function onClickSubmitEditUserPriv(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('priv_id_selector');
    var priv_id = selector.options[selector.selectedIndex].value;
    var lgsm_start = document.getElementById('lgsm_start').checked;
    var lgsm_restart = document.getElementById('lgsm_restart').checked;
    var lgsm_stop = document.getElementById('lgsm_stop').checked;
    var lgsm_update = document.getElementById('lgsm_update').checked;
    var lgsm_status = document.getElementById('lgsm_status').checked;
    var view_in_dash = document.getElementById('view_in_dash').checked;
    selector = document.getElementById('user_id_selector');
    var user_id = selector.options[selector.selectedIndex].value;
    selector = document.getElementById('server_id_selector');
    var server_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        lgsm_start: lgsm_start, 
        lgsm_restart: lgsm_restart, 
        lgsm_stop: lgsm_stop, 
        lgsm_update: lgsm_update, 
        lgsm_status: lgsm_status,
        view_in_dash: view_in_dash,
        user_id: user_id,
        server_id: server_id,
        priv_id: priv_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/userPrivs/action/edit', json, true);
}

function onClickSubmitDeleteUserPriv(event){
    var currentUsername = getUsername();
    var selector = document.getElementById('priv_id_selector');
    var priv_id = selector.options[selector.selectedIndex].value;
    var json = JSON.stringify({
        loggedUsername: currentUsername, 
        priv_id: priv_id
    });
    makeAjaxCall('popupModal', 'popupDialog', 'api/management/userPrivs/action/delete', json, true);
}
