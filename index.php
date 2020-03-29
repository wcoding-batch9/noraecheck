<?php
session_start();
require("./controller/controller.php");
/**
 * TODO: verify cookies, if cookies set, showAllPlaylists, if not showLandingPage
 */

try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    if(isset($_SESSION['memberId'])){
        if (isset($_REQUEST['action'])) {
            if ($action === 'showMyList') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                showAllPlaylists($memberId); 
            } else if ($action === 'showMySongs') {
                $playlistId = isset($_GET['playlistId']) ? $_GET['playlistId'] : '';
                showSongs($playlistId); 
            }
            else if ($action === 'logout') {
                logout(); 
            }  else if ($action === 'register') {
                $username = isset($_POST['loginNew']) ? $_POST['loginNew'] : '';
                $pass1 = isset($_POST['pwd']) ? $_POST['pwd'] : '';
                $pass2 = isset($_POST['pwdConf']) ? $_POST['pwdConf'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                signUp($email,$username,$pass1,$pass2);
            } else if ($action === 'login') {
                $username = isset($_POST['username']) ? $_POST['username'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                signIn($username,$password);
            } else if ($action === 'newPlaylist') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                $playlistName = isset($_POST['playlistName']) ? $_POST['playlistName'] : '';
                if (isset($memberId) &&  strlen(trim($playlistName)) === 0) {
                    showAllPlaylists($memberId);
                } else if (isset($memberId) && isset($playlistName) && strlen(trim($playlistName)) > 0) {
                    makePlaylist($_SESSION['memberId'], $_POST['playlistName']);
                } else {
                    throw new PDOException("issue with showAllPlaylists(username) - unable to fetch the playlists!");
                }
            } else if ($action === 'editPlaylist') {
                if (isset($_POST['newPlaylistName']) && isset($_POST['playlistId'])) {
                    editPlaylist(($_POST['newPlaylistName']), $_POST['playlistId']);
                }
            } else if ($action === 'deletePlaylist') {
                if (isset($_SESSION['memberId']) && isset($_SESSION['playlistId'])) {
                    deletePlaylist(($_SESSION['playlistId']), $_SESSION['memberId']);
                }
            } else if ($action === 'editBrandCode') {
                $playlistId = isset($_POST['playlistId']) ? $_POST['playlistId'] : '';
                $songId = isset($_POST['songId']) ? $_POST['songId'] : '';
                $tjCode = isset($_POST['tjCode']) ? $_POST['tjCode'] : '';
                $kumyoungCode = isset($_POST['kumyoungCode']) ? $_POST['kumyoungCode'] : '';
                if ($playlistId && $songId) {
                    editBrandCode($playlistId,$songId,$tjCode,$kumyoungCode);
                }  
            } else if ($action === 'deleteSong') {
                $songId = isset($_POST['songId']) ? $_POST['songId'] : '';
                echo $songId;
                if ($songId) {
                    deleteSong($songId);
                }
            } else if ($action === 'showProfile') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                $userName = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                showProfile($memberId,$userName);
            } else if ($action === 'editProfile') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                $oldUsername = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                $newUsername = isset($_POST['newUsername']) ? $_POST['newUsername'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $oldPwd = isset($_POST['oldPwd']) ? $_POST['oldPwd'] : '';
                $newPwd = isset($_POST['newPwd']) ? $_POST['newPwd'] : '';
                $newpwdConf = isset($_POST['newpwdConf']) ? $_POST['newpwdConf'] : '';
                editProfile($memberId,$oldUsername,$newUsername,$email,$oldPwd,$newPwd,$newpwdConf);
            } else if ($action === 'deleteProfile') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                deleteProfile($memberId);  
            } else if ($action === 'searchModal') {
                $song = isset($_REQUEST['hiddenSong']) ? $_REQUEST['hiddenSong'] : '';
                $singer = isset($_REQUEST['hiddenSinger']) ? $_REQUEST['hiddenSinger'] : '';
                $tj = isset($_REQUEST['hiddenTj']) ? $_REQUEST['hiddenTj'] : '';
                $kumyoung = isset($_REQUEST['hiddenKumyoung']) ? $_REQUEST['hiddenKumyoung'] : '';
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                $playlistId = isset($_SESSION['playlistId']) ? $_SESSION['playlistId'] : '';
                $searchCache = isset($_REQUEST['searchCache']) ? $_REQUEST['searchCache'] : '';
                $categoryCache = isset($_REQUEST['categoryCache']) ? $_REQUEST['categoryCache'] : '';
                searchModal($song,$singer,$tj,$kumyoung,$searchCache,$categoryCache,$memberId,$playlistId);
            } else if ($action === 'addToPlaylist') {
                $playlistId = isset($_REQUEST['playlistId']) ? $_REQUEST['playlistId'] : '';
                $song = isset($_REQUEST['song']) ? $_REQUEST['song'] : '';
                $singer = isset($_REQUEST['singer']) ? $_REQUEST['singer'] : '';
                $tj = isset($_REQUEST['tj']) ? $_REQUEST['tj'] : '';
                $kumyoung = isset($_REQUEST['kumyoung']) ? $_REQUEST['kumyoung'] : '';
                addToPlaylist($playlistId,urldecode($singer),urldecode($song),$tj,$kumyoung);
            } else if ($action === 'addSongToNewPlaylist') {
                $playlistName = isset($_REQUEST['playlistName']) ? $_REQUEST['playlistName'] : '';
                $song = isset($_REQUEST['song']) ? $_REQUEST['song'] : '';
                $singer = isset($_REQUEST['singer']) ? $_REQUEST['singer'] : '';
                $tj = isset($_REQUEST['tj']) ? $_REQUEST['tj'] : '';
                $kumyoung = isset($_REQUEST['kumyoung']) ? $_REQUEST['kumyoung'] : '';
                if (isset($_SESSION['memberId']) && $playlistName) {
                    addSongToNewPlaylist($_SESSION['memberId'], $playlistName,urldecode($singer),urldecode($song),$tj,$kumyoung);
                }
                addToPlaylist($playlistId,urldecode($singer),urldecode($song),$tj,$kumyoung);
            } else if ($action === 'search') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                $searchCache = isset($_REQUEST['searchCache']) ? $_REQUEST['searchCache'] : '';
                $categoryCache = isset($_REQUEST['categoryCache']) ? $_REQUEST['categoryCache'] : '';
                search($memberId,$searchCache,$categoryCache);     
            } else if ($action === 'showChallenge') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                showChallenge($memberId);
            }else if ($action === 'challengeInProgress') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                $round = isset($_REQUEST['round']) ? $_REQUEST['round'] : '0';
                $score = isset($_REQUEST['score']) ? $_REQUEST['score'] : '';
                challengeInProgress($memberId,$round,$score);
            }else if ($action === 'updateScore') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                $score = isset($_REQUEST['newScore']) ? $_REQUEST['newScore'] : '';
                $songId = isset($_REQUEST['songIdToUpdate']) ? $_REQUEST['songIdToUpdate'] : '';
                $round = isset($_REQUEST['round']) ? $_REQUEST['round'] : '';
                updateScore($memberId,$score,$songId,$round);
            } else if ($action ==='insertChallengeInfo') {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                insertChallengeInfo($memberId);                 
            } else {
                $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
                showAllPlaylists($memberId); 
            }
        } else {
            $memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : '';
            showAllPlaylists($memberId); 
        } 
        
    } else if ($action === 'register') {
        $username = isset($_POST['loginNew']) ? $_POST['loginNew'] : '';
        $pass1 = isset($_POST['pwd']) ? $_POST['pwd'] : '';
        $pass2 = isset($_POST['pwdConf']) ? $_POST['pwdConf'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        signUp($email,$username,$pass1,$pass2);
    } else if ($action === 'login') {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        signIn($username,$password);
    } else {
        $error = isset($_GET['error']) ? $_GET['error'] : '';
        $status = isset($_GET['success']) ? $_GET['success'] : '';
        showLandingPage($error,$status);
    }



}
    catch(PDOException $e) {
        $msg = $e->getMessage();
        $code = $e->getCode();
        $line = $e->getLine();
        $file = $e->getFile();
        require('./view/errorPDO.php');
    }
    catch(Exception $e) {
        $msg = $e->getMessage();
        $code = $e->getCode();
        $line = $e->getLine();
        $file = $e->getFile();
        require('./view/error.php');
    }
