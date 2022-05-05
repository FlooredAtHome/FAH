<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>    
    <script>
window.onload=function(){
    document.getElementById('btn-submit').disabled= true;
}
   function comparepass(){
        var p1 = document.getElementById('npwd');
        var p2 = document.getElementById('cpwd');
        if(p1.value == p2.value){
            document.getElementById('error').innerHTML="Passwords Match !!";
            document.getElementById('btn-submit').disabled= false;
        }
        else{
            document.getElementById('error').innerHTML="Password does not match";
            document.getElementById('btn-submit').disabled= true;
        }
    }
  
</script>
    </head>
    <body>