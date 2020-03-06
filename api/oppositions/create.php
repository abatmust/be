<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Opposition.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate oppositions object
  $opposition = new Opposition($db);

  // Get raw oppositioned data
  $data = json_decode(file_get_contents("php://input"));

  $opposition->opposants = $data->opposants;
  $opposition->defendeurs = $data->defendeurs;
  

  // Create opposition
  if($opposition->create()) {
    echo json_encode(
      array('message' => 'opposition Created')
    );
  } else {
    echo json_encode(
      array('message' => 'opposition Not Created')
    );
  }

