<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <!-- Carousal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!-- End Carousal -->
    <!-- JS -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/FAH/public/assets/css/comments.css"/>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/jquery-1.9.1.min.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/jquery-ui-1.10.3-custom.min.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/jquery_blockUI.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/comments_blog.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/header.js"></script>
        <script type= 'text/javascript' src="<?php echo base_url(); ?>/FAH/public/assets/js/logger.js"></script>
   
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script type="text/javascript" src="../public/assets/js/header.js"></script>
<script type="text/javascript" src="../public/assets/js/lightslider.js"></script>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light">
        <div class="container cust-border bg-white">
            <a class="navbar-brand">
                <img src="../public/assets/images/logofah.png" alt="" width="100" height="85" class="d-inline-block align-text-top img-fluid">   
            </a>
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
            <button id="logout" type="button" class="btn custbtn" style="" ><a href="<?= base_url('FAH/UserHome/logout');?>" style="color:white;">Logout</a></button>
        </div>
    </nav>

<div class="container mt-1">
    <div class="row">
        <div class=" col-lg-3 col-md-12 bg-white cust-right-border p-3">
            Hi,<br>
            <div class="text-center" style="color:rgb(65, 171, 255); font-size:17px;"><?=$po_data["Deal_Name"]?></div>
            <div class="pt-3">
                <table class="borderless" style="width:100%; table-layout: fixed;">
                    <tr>
                    <td class="labels" style="width:40%;">Email Address</td>
                    <td class="values" style="width:60%;"><?=$po_data["Email_Address"]?></td>
                    </tr>
                    <tr>
                    <td class="labels" >Other Phone</td>
                    <td class="values" ><?=$po_data["Other_Phone"]?></td>
                    </tr>
                    <tr>
                    <td class="labels" >Mobile Phone</td>
                    <td class="values" ><?=$po_data["Mobile_Phone"]?></td>
                    </tr>
                </table>
            </div>
            <hr class="m-1">
            <div class="pt-2 pb-2">
                <table class="borderless" style="width:100%; table-layout: fixed;">
                    <tr>
                    <td class="labels" style="width:40%;">Apt Date&Time</td>
                    <td class="values" ><?php $apt_date = new DateTime($po_data["Apt_1_Date_Time"], new DateTimeZone('UTC'));
                        $apt_date->setTimezone(new DateTimeZone('America/New_York'));
                        $apt_date =  $apt_date->format('d-M-Y h:i:s A');
                        print_r($apt_date);?></td>
                    </tr>
                </table>
            </div>
            <hr class="m-1">
            <span style="color:#182c6d;font-size: 17px;font-weight: 400;">Address Info</span><br>
            <div class="pt-1 pb-2">
                <table class="borderless" style="width:100%; table-layout: fixed;">
                    <tr>
                    <td class="labels" style="width:40%;">Street</td>
                    <td class="values" style="width:60%;"><?=$po_data["Street"]?></td>
                    </tr>
                    <tr>
                    <td class="labels" >Unit</td>
                    <td class="values" ><?=$po_data["Unit"]?></td>
                    </tr>
                    <tr>
                    <td class="labels" >City</td>
                    <td class="values" ><?=$po_data["City"]?></td>
                    </tr>
                    <tr>
                    <td class="labels" >State</td>
                    <td class="values" ><?=$po_data["State"]?></td>
                    </tr>
                    <tr>
                    <td class="labels" >Zip Code</td>
                    <td class="values" ><?=$po_data["Zip_Code"]?></td>
                    </tr>
                </table>
            </div>
            <hr class="m-1">
            <div class="row">
                <div class="col-6 bg-white" style="border-right:2px solid #c8c9ca;">
                    <?php $i=1; foreach($urls as $url){ ?>
                        <a data-bs-toggle="modal" data-bs-target="#prop<?=$i?>" class="float-none p-1" onclick="proptime('prop')" data-bs-toggle="tooltip" data-bs-placement="top" title="Proposal-<?=$i?>"><img src="../public/assets/images/proposal.png" alt="" width="30" height="20" class="d-inline-block align-text-top img-fluid"></a>
                        <div class="modal fade" id="prop<?=$i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Proposal <?=$i?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="container" style="padding-bottom:125%; position:relative; display:block; width: 100%">
                                    <iframe id="ViostreamIframe" width="100%" height="100%" src="<?=$url?>" frameborder="0" allowfullscreen="" style="position:absolute; top:0; left: 0"></iframe>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php $i++;} ?>
                </div>
                <div class="col-6 bg-white" style="display: flex; justify-content: center; align-items: center;">
                    <a href="#" class="btn btn-success float-none size-s text-decoration-none">Pay</a>
                </div>
            </div>
            <!-- <a href="#" type="application/pdf" class="btn btn-success float-none size-s text-decoration-none" onclick="proptime('inv')" >Invoice</a> -->
        </div>

        <div class="col-lg-6 col-md-12 bg-white ml-2 cust-right-border text-center p-3">
        <img id="img-high" src="<?=$mp_image_url?>" onerror="this.onerror=null; this.src='../public/assets/images/No_Image_Available.jpg'" alt="" class="img-fluid" class="img-fluid" style="width:600px; height:435px;">
            <!-- <div class="mt-2 container">
                <div class="mt-3 p-0">
                    <ul id="light-slider" class="image-fluid">
                        <li>
                        <img src="../public/assets/images/1.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(0)">
                        </li>
                        <li>
                        <img src="../public/assets/images/2.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(1)">
                        </li>
                        <li>
                        <img src="../public/assets/images/3.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(2)">
                        </li>
                        <li>
                        <img src="../public/assets/images/1.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(3)">
                        </li>
                        <li>
                        <img src="../public/assets/images/1.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(4)">
                        </li>
                        <li>
                        <img src="../public/assets/images/2.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(5)">
                        </li>
                        <li>
                        <img src="../public/assets/images/3.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(6)">
                        </li>
                        <li>
                        <img src="../public/assets/images/1.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(7)">
                        </li>
                    </ul>
                </div>       
            </div> -->
        </div>

        <div class="col-lg-3 col-md-12 bg-white ml-2 p-3 d-flex flex-column">
            <!-- <p>What's Happening</p>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>To-do's:</div><div class="bg-danger text-white third-col-items">1</div></div>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Unread Documents:</div><div class="bg-danger text-white third-col-items">7</div></div>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Messages:</div><div class="bg-danger text-white third-col-items">1</div></div>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Pending Change Orders:</div><div class="bg-danger text-white third-col-items">1</div></div>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Upcoming Selections:</div><div class="bg-danger text-white third-col-items">1</div></div>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Warranty items:</div><div class="bg-danger text-white third-col-items">1</div></div>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Surveys:</div><div class="bg-danger text-white third-col-items">1</div></div>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Invoices:</div><div class="bg-danger text-white third-col-items">1</div></div>
            <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Recent Daily Logs:</div><div class="bg-danger text-white third-col-items">1</div></div> -->
            <a data-bs-toggle="modal" data-bs-target="#faq">FAQ</a>
            <div class="modal fade" id="faq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">FAQ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed src="../public/assets/pdf/faq.pdf" width="1100px" height="650px" />
                        </div>
                    </div>
                </div>
            </div>


            
            <a data-bs-toggle="modal" data-bs-target="#warranty">Warranty</a>
            <div class="modal fade" id="warranty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warranty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed src="../public/assets/pdf/warranty.pdf" width="1100px" height="650px" />
                </div>
                </div>
            </div>
            </div>
            
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#light-slider").lightSlider({
            item: 4,
            autoWidth: false,
            slideMove: 1, // slidemove will be 1 if loop is true
            slideMargin: 10,

            addClass: '',
            mode: "slide",
            useCSS: true,
            cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
            easing: 'linear', //'for jquery animation',////

            speed: 400, //ms'
            auto: false,
            pauseOnHover: false,
            loop: false,
            slideEndAnimation: true,
            pause: 2000,

            keyPress: false,
            controls: true,
            prevHtml: '',
            nextHtml: '',

            rtl:false,
            adaptiveHeight:false,

            vertical:false,
            verticalHeight:500,
            vThumbWidth:100,

            thumbItem:10,
            pager: true,
            gallery: false,
            galleryMargin: 5,
            thumbMargin: 5,
            currentPagerPosition: 'middle',

            enableTouch:true,
            enableDrag:true,
            freeMove:true,
            swipeThreshold: 40,

            responsive : [],

            onBeforeStart: function (el) {},
            onSliderLoad: function (el) {},
            onBeforeSlide: function (el) {},
            onAfterSlide: function (el) {},
            onBeforeNextSlide: function (el) {},
            onBeforePrevSlide: function (el) {}
        });
    });

</script>

<div class="container mt-3">
    <div class="row">
        <div class=" col-lg-12 col-md-12 p-2 bg-white cust-right-border p-3">
            <div class="row bootstrap snippets bootdeys">
                <div class='fullpost clearfix'>
                    <div class='entry'>
                        <div id="comment_wrapper">
                            <div id="comment_form_wrapper">
                                <div id="comment_resp"></div>
                                <h4>Questions Panel<a href="javascript:void(0);" id="cancel-comment-reply-link">Cancel</a></h4>
                                <form id="comment_form" name="comment_form" action="" method="post">
                                    <div>
                                        <textarea name="comment_text" placeholder="Ask a question here..." id="comment_text" rows="5"></textarea>
                                    </div>
                                    <div>
                                        <input type="hidden" name="content_id" id="content_id" value="<?=$pid?>"/>
                                        <input type="hidden" name="reply_id" id="reply_id" value=""/>
                                        <input type="hidden" name="depth_level" id="depth_level" value=""/>
                                        <input type="submit" name="comment_submit" id="comment_submit" value="Submit Question" class="button text-decoration-none custbtn "/>
                                    </div>
                                </form>
                            </div>
                            <div class="commentbody">
                                <?php
                                echo $comments;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function refreshPage(){
    window.location.reload();
} 
</script>
</body>
</html>