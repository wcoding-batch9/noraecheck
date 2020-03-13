<?php $title = 'Welcome to noraecheck';?>
<?php $style = 'landingStyle.css';?>

<?php ob_start();?>
<div id="landingWrapper">
    <div id="brandBlock">
        <div class="brandName">noraecheck</div>
        <div class="brandName">노래책</div>
    </div>
    <div id="equalizer">
        <!-- include equalizer here -->
    </div>
    <div id="accountBtns">
        <div id="signIn" class="neonBlue">Sign in</div>
        <div id="createAccount" class="neonBlue">Create Account</div>
    </div>
</div>
<?php $content = ob_get_clean();?>
<?php require('defaultTemplate.php');?>