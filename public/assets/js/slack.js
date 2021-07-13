/*
    Fonction pour afficher les messages en fonction de l'id du groupe
    idGroup, url = id du groupe sélectionné, url des messages
    return = bloc html
 */
function showMessage(idGroup, url){
    $('#messageDiscussion').empty();
    $.getJSON(url+idGroup, function (messageArray) {

        let blockgroup = '';

        for (let i=0; i<messageArray.data.length; i++){
            console.log(messageArray.data[i]);

            blockgroup += `<li class="chat-left">
                                <div class="chat-avatar">
                                    <img src="/assets/img/507803.jpg" alt="Retail Admin">
                                    <div class="chat-name">${messageArray.data[i].idMember}</div>
                                </div>
                                <div class="chat-text">${messageArray.data[i].text}</div>
                                <div class="chat-hour">${messageArray.data[i].dateCreateHeure}<span class="fa fa-check-circle"></span></div>
                            </li>`
        }
        $('#messageDiscussion').append(blockgroup);
    });
}

/*
    Fonction pour afficher la liste des groupes de discussions
    url : url des groupes
    return : bloc html
 */

function listerGroup(url)
{
    $.getJSON(url, function (group) {

        let blockgroup = '';

        for (let i=0; i<group.groups.length; i++){
            blockgroup += `<li class="person" data-chat="person2" onclick="showMessage(${group.groups[i].id}, '/messages/ajax/')">
                                <div class="user">
                                    <img src="/assets/img/507803.jpg" alt="Retail Admin">
                                </div>
                                  <p class="name-time">
                                    <span class="name">${group.groups[i].name}</span>
                                    <span class="time">${group.groups[i].dateUpdate.date}</span>
                                </p>
                        </li>`
        }
        $('#groupDiscussion').append(blockgroup);
    });
}


window.addEventListener("load", function(event) {
    listerGroup(URL_GROUPE);
});