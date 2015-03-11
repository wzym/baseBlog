/*
При наведении курсора мыши на элемент списка новостей осуществляется
ajax-запрос, и блоке после списка появляется вся информация
по этой новости.
 */
window.onload = function() {
    var item = document.getElementById('listOfNews');
    item.onmouseover = function(e) {
        e = e || window.event;
        var id = e.toElement.id;
        ajax1(id);
    }

    function ajax1(id) {
        var request = new XMLHttpRequest();
        var path = 'news/ajaxOne/' + id;
        request.open('POST', path, true);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                result(request.responseText);
            }
        }
        request.send();
    }

    function result(output) {
        var gotNew = JSON.parse(output);
        document.getElementById('gotId').innerHTML = gotNew.id;
        document.getElementById('gotDate').innerHTML = gotNew.date;
        document.getElementById('gotTitle').innerHTML = gotNew.title;
        document.getElementById('gotText').innerHTML = gotNew.text;
    }
}