<?php
try {

  //host
  define("HOST", "localhost"); //const var

  //dbname
  define("DBNAME", "coffe-blend");

  //user
  define("USER", "root");

  //password
  define("PASS", "");

  $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . "", USER, PASS);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //throw error if something wrong with connection

  // if($conn == true){
  //   echo "Connection established";
  // }else{
  //   echo "Connection error";
  // }
} catch (PDOException $Exeption) {
  echo $Exeption->getMessage();
}


//helper function 
function numFormat($num, $num2 = null)
{
  return $num2 ? number_format((float)$num->price * $num2->quantity, 2, '.', '') : number_format((float)$num->price, 2, '.', '') . "€";
}
