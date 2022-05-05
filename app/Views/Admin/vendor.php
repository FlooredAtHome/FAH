<div class="container table-responsive mt-1">
  <div class="row">
    <div class="mb-2">
      <h3>Customers Detail:
      <button type="submit" name="submit" class="btn custbtn float-end" data-bs-toggle="modal" data-bs-target="#vendorInsert">Add Vendor</button></h3>
    </div>
    <?php if(session()->getTempdata('errorvend')): ?>
    <div class="alert alert-danger"> <?= session()->getTempdata('errorvend'); ?> </div>
    <?php endif; ?>
    <?php if(session()->getTempdata('successvend')): ?>
    <div class="alert alert-success"> <?= session()->getTempdata('successvend'); ?> </div>
    <?php endif; ?>
    <table id="vendorlist" class="table table-bordered table-hover align-middle" style="background: white; border-radius: 2px;">
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
    <?php for($i=0;$i<count($vendordata);$i++){ $values=$vendordata[$i]; ?>
    <tr>
    <td class="text-center"><button id="uidpass" data-uid="<?=$values['UID']?>" data-fid="<?=$values['FIRST_NAME']?>" data-lid="<?=$values['LAST_NAME']?>" data-eid="<?=$values['EMAIL']?>" type="submit" name="submit" class="btn custbtn">View</button></td>
    <td class="text-center"><button id="valueforward" data-uid="<?=$values['UID']?>" data-fid="<?=$values['FIRST_NAME']?>" data-lid="<?=$values['LAST_NAME']?>" data-eid="<?=$values['EMAIL']?>" type="submit" name="submit" class="btn custbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Update</button></td>
    <td><?=$values['FIRST_NAME']?></td>
    <td><?=$values['LAST_NAME']?></td>
    <td><?=$values['EMAIL']?></td>
    <td class="text-center"><form action="resetpasswordvendorLink" method="post">
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
        <form action="updateVendor" method="post">
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

<div class="modal fade" id="vendorInsert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Insert New Vendor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="insertVendor" method="post">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="firstname" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn custbtn">Insert</button>
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
      $('#vendorlist').DataTable();
  } );
</script>
</body>
</html>