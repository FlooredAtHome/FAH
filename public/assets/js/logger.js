function logload(rep,uid){
    var response = [{"uid":rep,"rep":rep}];
    var str_json = JSON.stringify(response);
    request= new XMLHttpRequest();
    request.open("POST", "Logloadhandler", true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function() { if (request.readyState === 4 && request.status === 200) { console.log(request.responseText); } }
    request.send(str_json);
}