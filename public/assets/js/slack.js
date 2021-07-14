//GROUPE

/*  Fonction pour afficher la liste des groupes de discussions
    url : url des groupes
    return : bloc html
 */
function listerGroup(url)
{
    //recupere les messages via un json
    $.getJSON(url, function (group) {

        let blockgroup = '';

        for (let i=0; i<group.groups.length; i++){
            //bloc HTML d'un groupe
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
        //Affiche le block au niveau de l'id groupDiscussion
        $('#groupDiscussion').append(blockgroup);
    });
}

/*  Fonction permettant de crée une discussion
 */
function ajouterGroupe()
{
}

//MESSAGE

/*  Fonction pour afficher les messages d'un groupe choisi
    idGroup-> int, url->str
    return : bloc html
 */
function showMessage(idGroup, url){
    // Vide le bloc de message
    $('#messageDiscussion').empty();
    //recupere les messages via un json
    $.getJSON(url+idGroup, function (messageArray) {

        let blockgroup = '';

        for (let i=0; i<messageArray.data.length; i++){
            //bloc HTML d'un message
            blockgroup += `<li class="chat-left">
                                <div class="chat-avatar">
                                    <img src="/assets/img/507803.jpg" alt="Retail Admin">
                                    <div class="chat-name">${messageArray.data[i].idMember}</div>
                                </div>
                                <div class="chat-text">${messageArray.data[i].text}</div>
                                <div class="chat-hour">${messageArray.data[i].dateCreateHeure}</div>
                            </li>`
        }
        //Affiche le block au niveau de l'id messageDiscussion
        $('#messageDiscussion').append(blockgroup);
    });
}

/*  Fonction permettant d'ajouter un message a la discussion via un champs de saisi.
    message->str
 */
function ajoutMessage(message)
{
}

//AUTOREFRESH

/*  Fonction permettant de refresh la partie discussion automatiquement toute les n secondes
 */
function autorefresh()
{
}

//Au chargement de la page nous chargeons les groupes de l'utilisateur
window.addEventListener("load", function(event) {
    listerGroup(URL_GROUPE);
});