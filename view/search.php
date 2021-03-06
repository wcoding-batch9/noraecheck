<?php $title = 'noraecheck';?>
<?php $style = 'style.css';?>

<?php ob_start();?>
<?php 
    if (!$_SESSION['username']) {
        header("location:index.php");
    }
    $email = isset($_GET['email']) ? $_GET['email'] : ''
?>
<div class="mainWrapper homePage gothamPro">
    <input type='hidden' name='modalDisplay' id='modalDisplay' value=<?=$modalDisplay?>>
    <input type='hidden' name='searchCache' id='searchCache' value=<?=$searchCache?>>
    <input type='hidden' name='searchCategory' id='searchCategory' value=<?=$categoryCache?>>
    <?php include('newSongModal.php'); ?>
    <!-- include banner php file instead of header tag -->
    <div id='search' class="gothamPro">
        <div id="searchOptions" class="searchOptions">
            <div class="searchOption" id="title" ><span>song</span></div>
            <div class="searchOption hidden" id="artist"><span>artist</span></div>
            <div class="searchOption hidden" id="id"><span>code</span></div>
        </div>
        <input type="text" name="entry" class = "entry"id="entry" size="30" maxlength="50" required/>
        <input type="hidden" name="category" id="category" value="title">
        <button type="reset"  id="resetSearch">cancel</button>
    </div>
    <script src="./public/js/searchBarDisplay.js"></script>

    <section id="results" class="gothamPro">
        <h1>Results</h1>
        <div id="searchResults">     
        <!-- add divs with the list of songs from js function -->
        </div>
    </section> 
    <script src="./public/js/modalSearch.js"></script>  
    <?php include('nav.php'); ?>
</div>
<script src="./public/js/songApi.js"></script>
<?php $content = ob_get_clean();?>
<?php require('template.php');?>

