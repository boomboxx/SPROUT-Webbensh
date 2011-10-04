<?php
// Session starten
session_start();

// Inhalt des kompletten Arrays zerstören
$_SESSION = array();

// Alle werte im $_COOKIE Array mit SetCookie löschen und das Verfallsdatum zurücksetzen
foreach( $_COOKIE as $key => $value )
  setCookie( $key, '', -3600 );

// Session zerstören
session_destroy();

// Redirect auf eine Seite durchführen, um die Cookie-Löschung wirksam werden zu lassen
// <url> muss natürlich durch eine gültige URL ersetzt werden
header('Location: index.php');
// Script abbrechen

exit();