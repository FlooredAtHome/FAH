<script>
    window.onload=function(){
    document.getElementById('btn-submit').disabled= true;
    var elem =document.getElementById('error');
    elem.style.display = "none";
    }
   function comparepass(){
        var p1 = document.getElementById('npwd');
        var p2 = document.getElementById('cpwd');
        var elem =document.getElementById('error');
        elem.style.display = "block";
        if (p1.value === '' && p2.value === '' || p1.value != p2.value ){
            document.getElementById('error').innerHTML="Password does not match";
            document.getElementById('btn-submit').disabled= true;
            elem.classList.remove("alert-success");
            elem.classList.add("alert-danger");
        }
        else if(p1.value == p2.value){
            document.getElementById('error').innerHTML="Passwords Match !!";
            document.getElementById('btn-submit').disabled= false;
            elem.classList.remove("alert-danger");
            elem.classList.add("alert-success");
        } 
    }
    </script>
    <!-- <script>
    window.onload=function(){
    document.getElementById('btn-submit').disabled = true;
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
  
</script> -->
<!-- <#?php
$hidden = ['uid'=> $uid]; 
echo form_open(base_url().'/FAH/Reset/update_password','',$hidden) ?>
<input type="text" id="npwd" name="npwd" placeholder="New Password" onkeyup="comparepass()">
<input type="text" id="cpwd" name="cpwd" placeholder="Confirm New Password" onkeyup="comparepass()">
<button type="submit" id='btn-submit'>Change pwd</button>
</form> -->



<div class="container">
<h2 class="mt-4 mb-5 text-center">Welcome New User</h2>
    <div class="row">
    <div class="col-4 p-5">
            <!-- <div class="card">
            <#?php
$hidden = ['uid'=> $uid]; 
echo form_open(base_url().'/FAH/Reset/update_password','',$hidden) ?>
  <div class="form-group">
    <label for="npwd">Email address</label>
    <input type="text" class="form-control" id="npwd" placeholder="Enter new password" onkeyup="comparepass()"/>
  </div>
  <div class="form-group">
    <label for="cpwd">Password</label>
    <input type="text" class="form-control" id="cpwd" placeholder="Confirm new password" onkeyup="comparepass()"/>
  </div>
  <button type="submit" id='btn-submit' class="btn mt-2 btn-success">change password</button>
</form>
<div class="alert alert-danger" role="alert" id = "error">
</div>

        </div> -->
            </div>
        <div class="col-sm-4"><div class="card">
<article class="card-body">
<!-- <a href="" class="float-right btn btn-outline-primary">Sign up</a> -->
<h4 class="card-title mb-4 mt-1">Reset Password</h4>
<?php
$hidden = ['uid'=> $uid]; 
echo form_open(base_url().'/FAH/UserHome/update_password','',$hidden) ?>
<div class="form-group">
<!-- <label>Your email</label> -->
<input class="form-control mt-3" id="npwd" name = "npwd" onkeyup="comparepass()" placeholder="Enter new password" type="text"/>
</div> <!-- form-group// -->
<div class="form-group">
<!-- <label>Your password</label> -->
<input class="form-control mt-3" id="cpwd" name = "cpwd" onkeyup="comparepass()" placeholder="Confirm new password" type="text"/>
</div> <!-- form-group// -->
<div class="form-group">
</div> <!-- form-group// -->
<div class="form-group mt-3">
<button type="submit" id ="btn-submit" class="btn btn-success btn-block"> Change password </button>
</div> <!-- form-group// -->
</form>
<div class="alert alert-danger mt-3" role="alert" id = "error">
</div>
</article>
</div></div>
        
        
        <div class="col-4">
        </div>
    </div>
</div>
</body>
</html>
