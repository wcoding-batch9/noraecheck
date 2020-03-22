<?php $title = 'Welcome to noraecheck';?>
<?php $style = 'landingStyle.css';?>

<?php ob_start();?>
    <div id="landingWrapper">

        <div id="brandBlock">
            <div class="brandName en">noraecheck</div>
            <div class="brandName kr">노래책</div>
        </div>

        <div id="equalizer">
            <?php include('equalizer.php');?>
        </div>

<div id="accountBtns">

<!-- Sign In Modal-->
<button id="signInText" class="btn" onclick="document.getElementById('id02').style.display='block'">Sign in</button>
    <div id="id02" class="modal">
        <?php 
        // if ($status == '1'){
        // echo '<p class="good">account successfully created</p> ';
        // }
        if ($error == 'logError'){
        echo '<p class="error">there are no accounts with that ID</p> ';
        }
        if ($error == 'passError'){
        echo '<p class="error">that password you\'ve entered is incorrect</p> ';
        }
        if ($error == 'missingField'){
        echo '<p class="error">please enter both fields</p> ';
        }
        ?>
        <form id="loginForm" class="modal-content animate" action="index.php?action=login" method="POST">
        <div class="imgcontainer">
        <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

<div class="container">

<!-- <form id="loginForm" method="POST" action="index.php?action=showMyList"> -->

    <p id="firstP"> please fill out all of the required fields</p>
        <p class="loginformP">
            <label class="field a-field a-field_a1">
                <input type="text" name="username" id="username" maxlength="15" class="field__input a-field__input" placeholder="e.g. Stas" required/>
                <span class="a-field__label-wrap">
                    <label for="username" class="a-field__label">Username</label>
                </span>
            </label>
        </p>

    <p class="loginformP">
        <label class="field a-field a-field_a3">
            <input type="password" name="password" id="passwordd" class="field__input a-field__input" placeholder="e.g. EunHye" required/>
                <span class="a-field__label-wrap">
                <label for="password" class="a-field__label">Password</label>
                </span>
        </label>
    </p>

    <p id="lastP">
        <input type="submit" name="submit" id="submit" value="login"/>
        <input type="reset" name="reset" id="reset" value="Reset"/>
    </p>

</div>
</div>
</form>
    <!-- </form> -->
<!-- Sign In Modal End -->

<!-- Sign Up Modal Start -->
<button id="createAccount" class="btn" onclick="document.getElementById('id01').style.display='block'">Create Account</button>

<div id="id01" class="modal">

<form class="modal-content animate" action="index.php" method="POST"><?php
if ($error == 'logError'){
echo '<p class="error">please make sure that your login fields are the same</p> ';
}
if ($error == 'passError'){
echo '<p class="error">please make sure that your passwords are the same</p> ';
}
if ($error == 'logOld'){
echo '<p class="error">that id has already been taken </p> ';
}
if ($error == 'mailError'){
echo '<p class="error">please enter a valid email address</p> ';
}
?>
<div class="imgcontainer">
<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
</div>

<div class="container">

<!-- 
<form method="POST" action="index.php"> -->

<p id="firstP"> please fill out all of the required fields</p>

<p>
<label class="field a-field a-field_a1">
<input type="text" name="loginNew" id="loginNew" maxlength="15" class="field__input a-field__input" placeholder="e.g. Stas" required/>
<span class="a-field__label-wrap">
<label for="loginNew" class="a-field__label">Login</label>
</span>
</label>
</p>

<p>
<label class="field a-field a-field_a2">
<input type="email" name="email" id="email" class="field__input a-field__input" placeholder="e.g. James" required/>
<span class="a-field__label-wrap">
<label type="email" class="a-field__label">Email</label>
</span>
</label>
</p>

<p>
<label class="field a-field a-field_a3">
<input type="password" name="pwd" id="pwd" class="field__input a-field__input" placeholder="e.g. EunHye" required/>
<span class="a-field__label-wrap">
<label for="pwd" class="a-field__label">Password</label>
</span>
</label>
</p>

<p>
<label class="field a-field a-field_a3">
<input type="password" name="pwdConf" id="pwdConf" class="field__input a-field__input" placeholder="e.g. Marie" required/>
<span class="a-field__label-wrap">
<label type="pwdConf" class="a-field__label">Confirm Password</label>
</span>
</label>
</p>

<p id="lastP">
<input type="hidden" name="action" id="action" value="register">
<input type="submit" name="submitRegister" id="submitRegister" value="Create"/>
<input type="reset" name="reset" id="reset" value="Reset"/>
</p>

<!-- </form> -->
</form>
</div>
</div>

<!-- Sign Up Modal End -->
<script src="./public/js/landingModal.js"></script>
<?php $content = ob_get_clean();?>
<?php require('template.php');?>
