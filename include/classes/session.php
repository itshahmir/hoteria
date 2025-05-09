<?php

include("database.php");
include("mailer.php");
include("form.php");

class Session
{
   var $username;
   var $userid;
   var $userlevel;
   var $time;
   var $logged_in;
   var $userinfo = array();
   var $url;
   var $referrer;

   function __construct()
   {
      $this->time = time();
      $this->startSession();
   }


   function startSession()
   {
      global $database;
      session_start();


      $this->logged_in = $this->checkLogin();


      if (!$this->logged_in) {
         $this->username = $_SESSION['username'] = GUEST_NAME;
         $this->userlevel = GUEST_LEVEL;
         $database->addActiveGuest($_SERVER['REMOTE_ADDR'], $this->time);
      } else {
         $database->addActiveUser($this->username, $this->time);
      }


      $database->removeInactiveUsers();
      $database->removeInactiveGuests();


      if (isset($_SESSION['url'])) {
         $this->referrer = $_SESSION['url'];
      } else {
         $this->referrer = "/";
      }


      $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
   }
function contains($haystack, $needle){
    return strpos($haystack, $needle) !== false;
}

   function checkLogin()
   {
      global $database;
      if (isset($_COOKIE['cookname']) && isset($_COOKIE['cookid'])) {
         $this->username = $_SESSION['username'] = $_COOKIE['cookname'];
         $this->userid   = $_SESSION['userid']   = $_COOKIE['cookid'];
      }


      if (
         isset($_SESSION['username']) && isset($_SESSION['userid']) &&
         $_SESSION['username'] != GUEST_NAME
      ) {

         if ($database->confirmUserID($_SESSION['username'], $_SESSION['userid']) != 0) {

            unset($_SESSION['username']);
            unset($_SESSION['userid']);
            return false;
         }


         $this->userinfo  = $database->getUserInfo($_SESSION['username']);
         $this->username  = $this->userinfo['username'];
         $this->userid    = $this->userinfo['userid'];
         $this->userlevel = $this->userinfo['userlevel'];
         return true;
      } else {
         return false;
      }
   }


   function login($subuser, $subpass)
   {
      global $database, $form;

      $field = "user";
      if (!$subuser || strlen($subuser = trim($subuser)) == 0) {
         $form->setError($field, "* Username not entered");
      }

      $field = "pass";
      if (!$subpass) {
         $form->setError($field, "* Password not entered");
      }


      if ($form->num_errors > 0) {
         return false;
      }


      $subuser = stripslashes($subuser);
      $result = $database->confirmUserPass($subuser, $subpass);


      if ($result == 1) {
         $field = "user";
         $form->setError($field, "* Username not found");
      } else if ($result == 2) {
         $field = "pass";
         $form->setError($field, "* Invalid password");
      }


      if ($form->num_errors > 0) {
         return false;
      }


      $this->userinfo  = $database->getUserInfo($subuser);
      $this->username  = $_SESSION['username'] = $this->userinfo['username'];
      $this->userid    = $_SESSION['userid']   = $this->generateRandID();
      $this->userlevel = $this->userinfo['userlevel'];


      $database->updateUserField($this->username, "userid", $this->userid);
      $database->addActiveUser($this->username, $this->time);
      $database->removeActiveGuest($_SERVER['REMOTE_ADDR']);



      setcookie("cookname", $this->username, time() + COOKIE_EXPIRE, COOKIE_PATH);
      setcookie("cookid",   $this->userid,   time() + COOKIE_EXPIRE, COOKIE_PATH);



      return true;
   }


   function logout()
   {
      global $database;
      if (isset($_COOKIE['cookname']) && isset($_COOKIE['cookid'])) {
         setcookie("cookname", "", time() - COOKIE_EXPIRE, COOKIE_PATH);
         setcookie("cookid",   "", time() - COOKIE_EXPIRE, COOKIE_PATH);
      }


      unset($_SESSION['username']);
      unset($_SESSION['userid']);


      $this->logged_in = false;


      $database->removeActiveUser($this->username);
      $database->addActiveGuest($_SERVER['REMOTE_ADDR'], $this->time);


      $this->username  = GUEST_NAME;
      $this->userlevel = GUEST_LEVEL;
   }

   ////////// Start Custom Functions
   function register($subuser, $subpass, $subemail)
   {
      global $database, $form, $mailer;

      $jumo2 = md5($_SESSION['CSRF_Code'] . '8j5j&*&K5jrffgF9wAJDIH' . 'JKHds998954(*)(*dfkjll');



      $field = "user";
      if (!$subuser || strlen($subuser = trim($subuser)) == 0) {
         $form->setError($field, "* Username not entered");
      } else {

         $subuser = stripslashes($subuser);
         if (strlen($subuser) < 5) {
            $form->setError($field, "* Username below 5 characters");
         } else if (strlen($subuser) > 30) {
            $form->setError($field, "* Username above 30 characters");
         } else if (!preg_match("/^([0-9a-z_])+$/", $subuser)) {
            $form->setError($field, "* Username not alphanumeric");
         } else if (strcasecmp($subuser, GUEST_NAME) == 0) {
            $form->setError($field, "* Username reserved word");
         } else if ($database->usernameTaken($subuser)) {
            $form->setError($field, "* Username already in use");
         } else if ($database->usernameBanned($subuser)) {
            $form->setError($field, "* Username banned");
         }
      }


      $field = "pass";
      if (!$subpass) {
         $form->setError($field, "* Password not entered");
      } else {

         $subpass = stripslashes($subpass);
         if (strlen($subpass) < 4) {
            $form->setError($field, "* Password too short");
         } else if (!preg_match("/^([0-9a-z])+$/", ($subpass = trim($subpass)))) {
            $form->setError($field, "* Password not alphanumeric");
         }
      }


      $field = "email";
      if (!$subemail || strlen($subemail = trim($subemail)) == 0) {
         $form->setError($field, "* Email not entered");
      } else {

         $regex = "/^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
            . "@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
            . "\.([a-z]{2,}){1}$/";
         if (!preg_match($regex, $subemail)) {
            $form->setError($field, "* Email invalid");
         }
         $subemail = stripslashes($subemail);
      }


      if ($form->num_errors > 0) {
         return 1;
      } else {
         if ($database->addNewUser($subuser, md5($subpass), $subemail)) {

            return 0;
         } else {
            return 2;
         }
      }
   }


   function editAccount($subcurpass, $subnewpass, $subemail)
   {
      global $database, $form;

      $jumo2 = md5($_SESSION['CSRF_Code'] . '8j5j&*&K5jrffgF9wAJDIH' . 'JKHds998954(*)(*dfkjll');


      if ($subnewpass) {

         $field = "curpass";
         if (!$subcurpass) {
            $form->setError($field, "* Current Password not entered");
         } else {

            $subcurpass = stripslashes($subcurpass);
            if (
               strlen($subcurpass) < 4 ||
               !preg_match("/^([0-9a-z])+$/", ($subcurpass = trim($subcurpass)))
            ) {
               $form->setError($field, "* Current Password incorrect");
            }

            if ($database->confirmUserPass($this->username, md5($subcurpass)) != 0) {
               $form->setError($field, "* Current Password incorrect");
            }
         }


         $field = "newpass";

         $subpass = stripslashes($subnewpass);
         if (strlen($subnewpass) < 4) {
            $form->setError($field, "* New Password too short");
         } else if (!preg_match("/^([0-9a-z])+$/", ($subnewpass = trim($subnewpass)))) {
            $form->setError($field, "* New Password not alphanumeric");
         }
      } else if ($subcurpass) {

         $field = "newpass";
         $form->setError($field, "* New Password not entered");
      }


      $field = "email";
      if ($subemail && strlen($subemail = trim($subemail)) > 0) {

         $regex = "/^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
            . "@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
            . "\.([a-z]{2,}){1}$/";
         if (!preg_match($regex, $subemail)) {
            $form->setError($field, "* Email invalid");
         }
         $subemail = stripslashes($subemail);
      }


      if ($form->num_errors > 0) {
         return false;
      }


      if ($subcurpass && $subnewpass) {
         $database->updateUserField($this->username, "password", md5($subnewpass));
      }


      if ($subemail) {
         $database->updateUserField($this->username, "email", $subemail);
      }


      return true;
   }











   ////////////////////////// END Custom Functions

   function isAdmin()
   {
      return ($this->userlevel == ADMIN_LEVEL ||
         $this->username  == ADMIN_NAME);
   }

   function isMaster()
   {
      return ($this->userlevel == MASTER_LEVEL);
   }

   function isAgent()
   {
      return ($this->userlevel == AGENT_LEVEL);
   }

   function isMember()
   {
      return ($this->userlevel == AGENT_MEMBER_LEVEL);
   }



   function generateRandID()
   {
      return md5($this->generateRandStr(16));
   }


   function generateRandStr($length)
   {
      $randstr = "";
      for ($i = 0; $i < $length; $i++) {
         $randnum = mt_rand(0, 61);
         if ($randnum < 10) {
            $randstr .= chr($randnum + 48);
         } else if ($randnum < 36) {
            $randstr .= chr($randnum + 55);
         } else {
            $randstr .= chr($randnum + 61);
         }
      }
      return $randstr;
   }
};



$session = new Session;


$form = new Form;