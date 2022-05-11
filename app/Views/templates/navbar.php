<body>
<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container cust-border bg-white">
            <!-- Logo Image -->
            <a class="navbar-brand" href="<?php echo base_url("FAH")?>">
                <img src=<?php echo base_url("FAH/public/assets/images/logofah.png");?> alt="" width="100" height="85" class="d-inline-block align-text-top img-fluid">   
            </a>
            
            <!-- Navigation bar By role Check -->

            <?php if($data["role"] == "1" && $data["page"] != "customerView" && $data["page"] != "vendorView") {
                // if(empty($data["page"]) || $data["page"] != "customerView" && $data["page"] != "vendorView"){
                ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="margin-right: auto;">
                    <button class="nav-link act active actived" id="nav-customer-tab" data-bs-toggle="tab" data-bs-target="#nav-customer" type="button" role="tab" aria-controls="nav-customer" aria-selected="true" style="color:#182c6d;">Customers</button>
                    <button class="nav-link act" id="nav-vendor-tab" data-bs-toggle="tab" data-bs-target="#nav-vendor" type="button" role="tab" aria-controls="nav-vendor" aria-selected="false" style="color:#182c6d;">Vendors</button>
                </div>
            </div>
            <?php  } 
            elseif($data["role"] == "2" && $data["page"] != "vendorView"|| $data["role"] == "1" && $data["page"] == "vendorView"){?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="margin-right: auto;">
                    <button class="nav-link act active actived"  id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="color:#182c6d;">Home</button>
                    <button class="nav-link act" id="nav-projects-tab" data-bs-toggle="tab" data-bs-target="#nav-projects" type="button" role="tab" aria-controls="nav-projects" aria-selected="false" style="color:#182c6d;">Projects</button>   
                    <button class="nav-link act" id="nav-products-tab" data-bs-toggle="tab" data-bs-target="#nav-products" type="button" role="tab" aria-controls="nav-products" aria-selected="false" style="color:#182c6d;">Products</button>
                </div>
            <?php } 
            elseif($data["role"]=="3"){ ?>
                <p id="user" hidden><?= esc($email)?></p>
			<div class="d-flex flex-column me-auto">
                <span class="me-auto">Contact Us</span>
                <span>NY: <a href="tel:+1(914)4494190" class="cuslink">914-449-4190</a></span>
                <span>NJ: <a href="tel:+1(201)5617366 "class="cuslink">201-561-7366</a></span>
            </div>
            <div class="justify-content-between d-flex me-2">
                <div class="me-1 p-2" style="border-right: 1px #c8c9ca solid;"><strong>Customer Engagement Manager</strong>
					<div class="d-flex">
            		<a href = "mailto: <?=$email?>"><i class='fa fa-envelope' aria-hidden="true" style="font-size: 15.5px; padding-top:5px; color: #717171;"></i></a><span style="margin-left:5px;"><?=$name?></span>:<a class="cuslink" href="tel:contact">123456789</a>
					</div>
				</div>
            	<div class="me-3 p-2"><strong>Customer Success Manager</strong><br>
					<div class="d-flex">
            		<a href = "mailto: <?=$email?>"><i class='fa fa-envelope' aria-hidden="true" style="font-size: 15.5px; padding-top:5px; color: #717171;"></i></a><span style="margin-left:5px;"><?=$name?></span>:<a class="cuslink" href="tel:contact">123456789</a>
					</div>
				</div>
            </div>
            <?php } ?>
                <!-- Logout Button -->
                <div class="d-flex">
                    <?php if($data["role"]=="1") {?>
                        <button class="btn btn-primary me-5" id = "addVendor" data-bs-toggle="modal" data-bs-target="#vendorInsert">Add Vendor</button>
                    <!-- <button type="submit" id="addVendor" name="submit" class="btn custbtn float-end hidden" data-bs-toggle="modal" data-bs-target="#vendorInsert" style="margin-right: 30px; margin-bottom: 24px;">Add Vendor</button> -->
                    <?php } ?>
                    <!-- <div class="pt-3 d-flex flex-column align-items-center"> -->
                        <button type="button" class="btn btn-danger ml-2" style="" ><a class="text-decoration-none" href="<?= base_url('FAH/UserHome/logout');?>" style="color:white;">Logout</a></button>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </nav>