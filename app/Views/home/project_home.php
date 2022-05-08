<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container cust-border bg-white">
            <a class="navbar-brand"  href="<?php echo base_url("FAH")?>">
                <img src="../../public/assets/images/logofah.png" alt="" width="100" height="85" class="d-inline-block align-text-top img-fluid">   
            </a>
            <button type="button" class="btn custbtn" style="" ><a class="text-decoration-none" href="<#?= base_url('FAH/Login/logout');?>" style="color:white;">Logout</a></button>
            
        </div>
    </nav>

    <div class="accordion container mt-1" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="project_detials">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#project_detials_collapseOne" aria-expanded="true" aria-controls="project_detials_collapseOne">
               Project Details
            </button>
            </h2>
            <div id="project_detials_collapseOne" class="accordion-collapse collapse show" aria-labelledby="project_detials">
            <div class="accordion-body">
            <div style="padding: 15px;">
                            <table class="" style="width:100%; table-layout: fixed;border: 1px solid #eddfdf;">
                                <tr>
                                <td class="labels">Name</td>
                                <td class="values"><?=$proj_data["name"]?></td>
                                <td class="labels" >Email</td>
                                <td class="values" ><?=$proj_data["Email"]?></td>
                                </tr>
                                <tr>
                                    <td class="labels" >Unit</td>
                                    <td class="values" ><?=$proj_data["Unit"]?></td>
                                    <td class="labels" >Street</td>
                                    <td class="values" ><?=$proj_data["Street"]?></td>
                                </tr>
                                <tr>
                                    <td class="labels" >City</td>
                                    <td class="values" ><?=$proj_data["City"]?></td>
                                    <td class="labels" >State</td>
                                    <td class="values" ><?=$proj_data["State"]?></td>
                                </tr>
                                <tr>
                                    <td class="labels" >Zip Code</td>
                                    <td class="values" ><?=$proj_data["Zip Code"]?></td>
                                    <td class="labels" >Phone</td>
                                    <td class="values" ><?=$proj_data["Phone"]?></td>
                                </tr>
                            </table>
                        </div>
        
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="job_ticket">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#job_ticket_collapse" aria-expanded="false" aria-controls="job_ticket_collapse">
                Job Ticket
            </button>
            </h2>
            <div id="job_ticket_collapse" class="accordion-collapse collapse" aria-labelledby="job_ticket">
            <div class="accordion-body">
                <button style="line-height: 1;" id="doc_pre_view" data-key="Job Ticket" data-src="<?=$proj_data["Job Ticket Url"]?>" type="submit" name="submit" class="btn" data-bs-toggle="modal" data-bs-target="#preview_modal">
                    <i class="fa fa-file-pdf-o fa-5x" style="color: red;" aria-hidden="true"></i>
                </button>    
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="vendor_invoice">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vendor_invoice_collapse" aria-expanded="false" aria-controls="vendor_invoice_collapse">
               Invoice
            </button>
            </h2>
            <div id="vendor_invoice_collapse" class="accordion-collapse collapse" aria-labelledby="vendor_invoice">
            <div class="accordion-body">
                <button style="line-height: 1;" id="doc_pre_view" data-key="Vendor Invoice" data-src="<?=$proj_data["Vendor Invoice Url"]?>" type="submit" name="submit" class="btn" data-bs-toggle="modal" data-bs-target="#preview_modal">
                    <i class="fa fa-file-pdf-o fa-5x" style="color: red;" aria-hidden="true"></i>
                </button>  

                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header" id="proj_tollgate">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#proj_tollgate_collapse" aria-expanded="false" aria-controls="proj_tollgate_collapse">
               Project Tollgates
            </button>
            </h2>
            <div id="proj_tollgate_collapse" class="accordion-collapse collapse" aria-labelledby="proj_tollgate">
            <div class="accordion-body">
                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="end_proj_checklist">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#end_proj_checklist_collapse" aria-expanded="false" aria-controls="end_proj_checklist_collapse">
                End of project checklist
            </button>
            </h2>
            <div id="end_proj_checklist_collapse" class="accordion-collapse collapse" aria-labelledby="end_proj_checklist">
            <div class="accordion-body">
                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
        </div>

        <script  type="text/javascript">
                $(document).on("click", "#doc_pre_view", function () {
                    if($(this).data('src').includes(".pdf"))
                    {
                        $("#preview_modal embed").attr("src",$(this).data('src'));
                        $("#preview_modal h5").html($(this).data('key'));
                    }   
                  
                });

                
            </script>
    </div>
    <div class="modal fade" id="preview_modal" tabindex="-1"  style="width:90%;height:90vh;" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed style="width:100%;height:80vh;" src=""/>
                </div>
            </div>
        </div>
    </div>

</body>
</html>