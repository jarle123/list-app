



/* TODO::
  * Listener for remove checkbox
  * Animation for listitem removal
  *
  *
  *
  *3z3BRCKXXqBSQAr
   * */


let btnAddList = document.getElementById("btn-add-list");
let btnsDelList = document.getElementsByClassName('btn-del-list');

window.onload = function () {

    let inputNewListItem = document.getElementById('newListItem');

    // Listener for input add new list item
    if (inputNewListItem) {
        inputNewListItem.addEventListener('keyup', function (event) {
            if (event.key === 'Enter') {
                insertListItem(inputNewListItem.value);

                this.value = "";
            }


        });
    }


    let closeX = document.querySelectorAll('.closeX');


    closeX.forEach(function(el) {
        el.addEventListener('click',function () {
           // let listItemId =
            let parentEl = this.parentElement;
            let checksBoxListItem = parentEl.querySelector('input[type=checkbox]');

            if (checksBoxListItem) {

                var checksBoxListItemId = checksBoxListItem.value
            }

            console.warn("clickety, id: ", checksBoxListItemId);



            let xhr = new XMLHttpRequest();

            xhr.open('POST', 'ajax.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('Cache-control', 'no-cache');
            xhr.send('ajaxAction=updateListItem&column=active&newValue=0&listItemId=' + checksBoxListItemId);

            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    console.warn("list item removed: " + this.response);

                    // remove list item
                    parentEl.remove();
                }
                else if (this.readyState === 4 && this.status !== 200) {
                    console.warn("failed");
                }
            };

        });
    });

    //closeX.forEach(function(el) {

      /*  el.addEventListener('click', function () {
            console.warn("clickety");
        });*/


};


if (btnAddList) {
    btnAddList.addEventListener("click", function () {
        // Add new list to list tree
        let list = '<ul> </ul>';
        let listContainer = document.getElementById('list-container');


    });
}


if (btnsDelList) {
 /*
    btnsDelList.forEach(function (btn) {
  */




}


function insertListItem(name) {

    let inputListId = document.getElementById('list-id-1');
    let listId = 0;

    if (inputListId) {
        listId = inputListId.value;

        let xhr = new XMLHttpRequest();

        xhr.open('POST', 'ajax.php');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('Cache-control', 'no-cache');
        xhr.send("ajaxAction=insertListItem&name=" + name + "&listId=" + listId);




        xhr.onreadystatechange = function (ev) {
            console.warn("onreadystatechange");

            if (this.readyState === 4 && this.status === 200) {
                console.warn("YAYk " + this.responseText);
                let list = document.getElementById('list-1');
                let liNewListItem = document.getElementById('li-new-list-item');
                let newItem = document.createElement('li');
                let textNode = document.createTextNode(name);
                newItem.appendChild(textNode);
                list.insertBefore(newItem, liNewListItem);
               // let listContainer = document.getElementById('list-container-' + listId);

            }
            else if (this.readyState === 4 && this.status !== 200) {
                console.warn("FAILED XHR");
            }
        };
    }
    else {
        console.warn("no list id found");
    }


}









