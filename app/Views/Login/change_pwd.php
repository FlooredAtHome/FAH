
<?php echo view("templates/header");
$hidden = ['uid'=> $uid]; 
echo form_open(base_url().'/FAH/Reset/update_password','',$hidden) ?>
<input type="text" id="npwd" name="npwd" placeholder="New Password" onkeyup="comparepass()">
<input type="text" id="cpwd" name="cpwd" placeholder="Confirm New Password" onkeyup="comparepass()">
<button type="submit" id='btn-submit btn-success'>Change pwd</button>
</form>
<p id="error"></p>
<script>
    window.onload=function(){
    document.getElementById('btn-submit').disabled= true;
    }
   function comparepass(){
        var p1 = document.getElementById('npwd');
        var p2 = document.getElementById('cpwd');
        if (p1.value === '' && p2.value === '' || p1.value != p2.value ){
            document.getElementById('error').innerHTML="Password does not match";
            document.getElementById('btn-submit').disabled= true;
        }
        else if(p1.value == p2.value){
            document.getElementById('error').innerHTML="Passwords Match !!";
            document.getElementById('btn-submit').disabled= false;
        } 
    }
    </script>
</body>
</html>
