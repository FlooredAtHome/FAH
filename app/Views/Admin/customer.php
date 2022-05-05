
    <div class="container table-responsive mt-1">
        <div class="row">
            <h3>Customers Detail:</h3><br>
            <?php if(session()->getTempdata('errorcust')): ?>
            <div class="alert alert-danger"> <?= session()->getTempdata('errorcust'); ?> </div>
            <?php endif; ?>
            <?php if(session()->getTempdata('successcust')): ?>
            <div class="alert alert-success"> <?= session()->getTempdata('successcust'); ?> </div>
            <?php endif; ?>
                        <table id="customerlist" class="table table-bordered table-hover align-middle" style="background: white; border-radius: 2px;">
                        <thead>
                        <tr>
                        <th>View</th>
                        <th>Update</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Reset Password</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for($i=0;$i<count($customerdata);$i++){ $values=$customerdata[$i]; ?>
                        <tr>
                        <td class="text-center">
                          <!-- <form action="customerView" method="post">
                            <input type="text" name="UID" value="<#?=$values['UID']?>" class="d-none"/> -->
                            <button type="submit" name="submit" class="btn custbtn"><a class="text-decoration-none" href="customerView?id=<?=$values['UID']?>" style="color:white;">View</a></button>
                          <!-- </form> -->
                        </td>
                        <td class="text-center"><button id="valueforward" data-uid="<?=$values['UID']?>" data-fid="<?=$values['FIRST_NAME']?>" data-lid="<?=$values['LAST_NAME']?>" data-eid="<?=$values['EMAIL']?>" type="submit" name="submit" class="btn custbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Update</button></td>
                        <td><?=$values['FIRST_NAME']?></td>
                        <td><?=$values['LAST_NAME']?></td>
                        <td><?=$values['EMAIL']?></td>
                        <td class="text-center"><form action="resetpasswordcustomerLink" method="post">
                        <input type="text" name="EMAIL" value="<?=$values['EMAIL']?>" class="d-none"/>
                        <button id="resetbtn" name="submit" type="submit" class="btn custbtn">Send Mail</button>
                        </form></td>                        
                        </tr>
                        <?php }?>
                        </tbody>
                        </table>
</div>
</div>


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Customers Detail Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="updateCustomer" method="post">
            <input id="uid" type="text" name="uid" class="form-control d-none" value=""/>
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input id="fid" type="text" name="newfirstname" class="form-control" value="">
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input id="lid" type="text" name="newlastname" class="form-control" value="">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input id="eid" type="email" name="newemail" class="form-control" value="">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn custbtn">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>

$(document).on("click", "#resetbtn", function (){
  var email = $(this).data('email');
  $("#email").val( email );
});

$(document).on("click", "#valueforward", function () {
    
     var userid = $(this).data('uid');
     $(".modal-body #uid").val( userid );
 
    var fvalue = $(this).data('fid');
    $(".modal-body #fid").val( fvalue );

    var lvalue = $(this).data('lid');
    $(".modal-body #lid").val( lvalue );
  
    var evalue = $(this).data('eid');
    $(".modal-body #eid").val( evalue );
}); 
</script>
<script>
    $(document).ready( function () {
      $('#customerlist').DataTable();
  } );
</script>
</body>
</html>