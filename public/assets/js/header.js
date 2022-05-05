window.onload=function(){
    document.getElementById("proptable").style.display="none";
    document.getElementById("logintable").style.display="block";
    document.getElementById("invtable").style.display="none";
}
var userlogs = [];
var invlogs=[];
// var email=document.getElementById("user").innerHTML;

function switchlog(val){
    const arr = ['logintable','proptable','invtable'];
    var num = arr.indexOf(val);
    if(arr.indexOf(val) != -1){
        var rem = arr.splice(num,1);
    }
    for(let i=0;i<arr.length;i++){
        document.getElementById(arr[i]).style.display="none";
    }
    document.getElementById(rem).style.display="block";
}
function givehigh(elem){
    var images=document.getElementsByName("carousel-img");
    var abc = document.getElementById("img-high").src;
    var img_src = images[elem].src;
    document.getElementById("img-high").src = img_src;
    console.log(img_src);
}

function proptime(btntime){
    var email=document.getElementById("user").innerHTML;
    let time1 = Date();
    let proptime = Date.now()/1000;
    var proplogs = [{"email":email,"proptime":proptime,"clicked":btntime}];
    var str_json = JSON.stringify(proplogs);
    request= new XMLHttpRequest();
    request.open("POST", "JSONhandler", true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function() { if (request.readyState === 4 && request.status === 200) { console.log(request.responseText); } }
    request.send(str_json);
}