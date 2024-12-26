<?php
// controller to log the user out.
// destroy session, delete session files,  expire the cookie, redirect user 
logout();


header('location: /');
exit(); 