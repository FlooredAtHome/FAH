<?php
$hidden = ['uid'=> $uid]; 
echo form_open(base_url().'/FAH/Reset/update_password','',$hidden) ?>
<input type="text" id="npwd" name="npwd" placeholder="New Password">
<input type="text" id="cpwd" name="cpwd" placeholder="Confirm New Password" onkeyup="comparepass()">
<button type="submit" id='btn-submit'>Change pwd</button>
</form>
<p id="error"></p>
    </body>
</html>
