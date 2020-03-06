<?php

  // // Headers
  //header('Access-Control-Allow-Origin: *');
  // // header('Content-Type: application/json');

  // include_once '../../config/Database.php';
  // include_once '../../models/User.php';
  // // Instantiate DB & connect
  // $database = new Database();
  // $db = $database->connect();
  // // Instantiate blog category object
  // $user = new User($db);
  // $data = json_decode(file_get_contents("php://input"));

  // // Get ID
  // $result = $user->login($data->user);
  
  // // Get row count
  // $num = $result->rowCount();

  // // Check if any categories
  // if($num > 0) {
  //   $logedin = true;

  // }else{
  //   $logedin = false;
  // }
  $data = json_decode(file_get_contents("php://input"));
 
  echo json_encode(
    array('message' => $data)
    
  );

