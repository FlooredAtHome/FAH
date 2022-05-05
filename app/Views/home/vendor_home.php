<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vendor Home</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    
    <!-- End Carousal -->
    <!-- JS -->
   
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- <script type="text/javascript" src="../public/assets/js/header.js"></script> -->
    <!-- <script type="text/javascript" src="../public/assets/js/weather.js"></script> -->
    <!-- <script type="text/javascript" src="../public/assets/js/lightslider.js"></script> -->
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.jqueryui.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.jqueryui.min.js"></script>
<style>
    .actived {
        color: black !important;
    }
    #addVendor {
        display: none;
    }
</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container cust-border bg-white">
            <a class="navbar-brand">
                <img src="../public/assets/images/logofah.png" alt="" width="100" height="85" class="d-inline-block align-text-top img-fluid">   
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="margin-right: auto;">
                    <button class="nav-link act active actived"  id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="color:#182c6d;">Home</button>
                    <button class="nav-link act" id="nav-projects-tab" data-bs-toggle="tab" data-bs-target="#nav-projects" type="button" role="tab" aria-controls="nav-projects" aria-selected="false" style="color:#182c6d;">Projects</button>   
                    <button class="nav-link act" id="nav-products-tab" data-bs-toggle="tab" data-bs-target="#nav-products" type="button" role="tab" aria-controls="nav-products" aria-selected="false" style="color:#182c6d;">Products</button>
                
                
                </div>
                <div class="d-flex align-items-center">
                    <button type="submit" id="addVendor" name="submit" class="btn custbtn float-end hidden" data-bs-toggle="modal" data-bs-target="#vendorInsert" style="margin-right: 30px; margin-bottom: 24px;">Add Vendor</button>
                    <div class="pt-3 d-flex flex-column align-items-center">
                        <button type="button" class="btn custbtn" style="" ><a class="text-decoration-none" href="<?= base_url('FAH/Login/logout');?>" style="color:white;">Logout</a></button>
                        
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <?php if(session()->getTempdata('errorvendhome')): ?>
            <div class="alert alert-danger"> <?= session()->getTempdata('errorvendhome'); ?> </div>
            <?php endif; ?>
            <?php if(session()->getTempdata('successvendhome')): ?>
            <div class="alert alert-success"> <?= session()->getTempdata('successvendhome'); ?> </div>
            <?php endif; ?>
            <div class="container mt-1">
                <div class="row">
                    <div class=" col-lg-3 bg-white cust-right-border p-3">
                        <div class="pt-3">
                            <table class="borderless" style="width:100%; table-layout: fixed;">
                                <tr>
                                <td class="labels" style="width:40%;">Name</td>
                                <td class="values" style="width:60%;"><?=$vendor_data["Price_Book_Name"]?></td>
                                </tr>
                                <tr>
                                <td class="labels" >Address</td>
                                <td class="values" ><?=$vendor_data["Address"]?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-9 bg-white ml-2 cust-right-border text-center p-3">
                    <div class="container table-responsive mt-1">
                        <div class="pt-3">
                            <table id="paper_work"  class="table table-bordered table-hover" style="background: white; border-radius: 2px;border-bottom: 1px solid #dee2e6;border-top: 1px solid #dee2e6;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Document</th>
                                        <th>Expiration Date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($paper_work_data as $k=>$v) { 
                                        if(!str_contains($k, "Exp. Date") && !str_contains($k, "Status")){?>
                                            <tr>
                                                <td style="text-align: left;"><?=$k?></td>
                                                 <?php if(isset($v) && !empty($v)):?>
                                                    <td>
                                                        <button style="line-height: 1;" id="doc_pre_view"  data-key="<?=$k?>" data-src="<?=$v?>" type="submit" name="submit" class="btn custbtn" data-bs-toggle="modal" data-bs-target="#preview_modal">view</button>
                                                    </td>
                                                <?php else: ?> 
                                                    <td></td>
                                                <?php endif; ?>
                                                <td><?=$paper_work_data[$k.' Exp. Date']?></td> 
                                                <td style="text-align: left;"><?=$paper_work_data[$k.' Status']?></td>
                                                <td>
                                                    <?php if($paper_work_data[$k.' Status'] === "" || $paper_work_data[$k.' Status'] == "Rejected" || $paper_work_data[$k.' Status'] == "Expiring Soon" ):?>
                                                        <button style="line-height: 1;" id="doc_upl_btn" data-key="<?=$k?>" data-v-id="<?=$vendor_data['id']?>" type="submit" name="submit" class="btn custbtn" data-bs-toggle="modal" data-bs-target="#upload_modal">Upload</button>
                                                    <?php else: ?> 
                                                        <button style="line-height: 1;" disabled type="submit" name="submit" class="btn custbtn" >Upload</button>
                                                    <?php endif; ?>        
                                                </td>
                                            </tr>
                                         <?php }?>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>   
                    </div>
                </div>
            </div>

            <script  type="text/javascript">
                $(document).on("click", "#doc_pre_view", function () {
                    if($(this).data('src').includes(".pdf"))
                    {
                        $("#preview_modal embed").attr("src",$(this).data('src'));
                        $("#preview_modal embed").css("display","block");
                        $("#preview_modal img").css("display","none");
                        $("#preview_modal h5").html($(this).data('key'));
                    }   
                    else
                    {
                        $("#preview_modal img").attr("src",$(this).data('src'));
                        $("#preview_modal embed").css("display","none");
                        $("#preview_modal img").css("display","block");
                        $("#preview_modal h5").html($(this).data('key'));
                    }
                });

                $(document).on("click", "#doc_upl_btn", function () {
                    $("#upload_modal #uploaded_file").val( '' );

                    $("#upload_modal #v_id").val( $(this).data('v-id') );
                    $("#upload_modal #field").val( $(this).data('key') );




                });
            </script>
        </div>        

        <div class="tab-pane fade" id="nav-projects" role="tabpanel" aria-labelledby="nav-projects-tab">
            <div class="container table-responsive mt-1">
                <div class="row">
                    <div class="mb-2">
                        <h3>Projects</h3>
                    </div>
                    <table id="vendor_proj_list" class="table table-bordered table-hover align-middle" style="background: white; border-radius: 2px;">
                        <thead>
                            <tr>
                                <th>View</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ven_projs as $values) { ?>
                            <tr>
                                <td class="text-center">
                                    <button type="submit" name="submit" class="btn custbtn"><a class="text-decoration-none" href="projectView/<?=$values['id']?>" style="color:white;">View</a></button>
                                </td>
                                <td><?=$values['name']?></td>
                                <td></td>               
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
        <div class="tab-pane fade" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
            <div class="container table-responsive mt-1">
                    <div class="row">
                        <div class="mb-2">
                            <h3>Products</h3>
                        </div>
                        <table id="vendor_prod_list" class="table table-bordered table-hover align-middle" style="background: white; border-radius: 2px;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Proposed Price</th>
                                    <th>Status</th>
                                    <th>Propose New</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $values) { ?>
                                <tr>
                                    <td><?=$values['Products']['name']?></td>
                                    <td><?=$values['Price']?></td>
                                    <?php if($values["Status"]=== "Proposed"): ?>
                                        <td><?=$values['Proposed_Price']?></td>
                                    <?php else: ?> 
                                        <td></td>
                                    <?php endif; ?>
                                    <td><?=$values['Status']?></td>
                                    <td class="text-center">
                                    <?php if($values["Status"]=== "Proposed"): ?>
                                        <button style="line-height: 1;" disabled type="submit" name="submit" class="btn custbtn" >Propose</button>
                                    <?php else: ?> 
                                        <button style="line-height: 1;"  id="pro_propose_btn" data-rec-id="<?=$values["id"]?>" data-pro-name="<?=$values['Products']['name']?>" type="submit" name="submit" class="btn custbtn" data-bs-toggle="modal" data-bs-target="#pro_price_props_modal">Propose</button>
                                    <?php endif; ?>
                                   

                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script  type="text/javascript">
            

                $(document).on("click", "#pro_propose_btn", function () {
                    $("#pro_price_props_modal #proposed_price" ).val( '' );
                    $("#pro_price_props_modal #rec_id").val( $(this).data('rec-id') );
                    $("#pro_price_props_modal h5").html( $(this).data('pro-name') );

                });
            </script>                        


        </div>  
    </div>
    
    <div class="modal fade" id="preview_modal" tabindex="-1"  style="width:90%;height:90vh;" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img style="display:none;width:100%;height:100%;" src="" />
                    <embed style="display:none;width:100%;height:80vh;" src=""/>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upload_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="upload_doc" method="post" enctype="multipart/form-data">
                        <input id="uid" type="text" name="uid" class="form-control d-none" value=""/>
                        <div class="mb-3">
                            <label class="form-label">Upload File</label>
                            <input id="uploaded_file" type="file" required name="uploaded_file" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <input id="v_id" type="hidden" required name="v_id" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <input id="field" type="hidden" required name="field" class="form-control" value="">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn custbtn">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="pro_price_props_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Propose</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="poropose_new_price" method="post" >
                        <div class="mb-3">
                            <label class="form-label">Propose New Price</label>
                            <input id="proposed_price" type="number" required step=".01" name="proposed_price" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <input id="rec_id" type="hidden" required name="rec_id" class="form-control" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn custbtn">Propose</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("nav-tab");
        var btns = header.getElementsByClassName("act");
        console.log(btns.length);
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("actived");
        current[0].className = current[0].className.replace(" actived", "");
        this.className += " actived";
        });
        }

      

        
      
    </script>
     <script>
        $(document).ready( function () 
        {
            $('#vendor_proj_list').DataTable({  responsive: true});


            $('#vendor_prod_list').DataTable({
                responsive: true
            });
        
            $('#paper_work').DataTable({

                paging: false,
                searching: false,
                ordering:  false,
                bInfo : false,
                display :"stripe",
                responsive: true,
                "sDom": 't'

            });
        });

   

    </script>

    </body>

    </html>