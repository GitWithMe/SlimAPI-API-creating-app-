<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Route to all customers(GET)

$app->get('/api/customers',function(Request $request, Response $response){
   $sql = "SELECT * FROM customers";

   try{
   	//Get Database Object where db object taken from db.php
   	$db = new db();
   	//Connect
   	$db = $db->connect();

  //Fetching All the queries from the Customers Database using PDO
    $stmt = $db->query($sql);
    $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    //Encoding into API 
    echo json_encode($customers);

   } 
   catch(PDOException $e){
   	echo '{"error": {"text": '.$e->getMessage().'}';
   	   }
   	
}); 

//Route to single customer(GET)

$app->get('/api/customer/{id}',function(Request $request, Response $response){
    
 //getting id of a particular customer from DB
 $id = $request->getAttribute('id');   

   $sql = "SELECT * FROM customers WHERE id = $id";

   try{
   	//Get Database Object where db object taken from db.php
   	$db = new db();
   	//Connect
   	$db = $db->connect();

  //Fetching All the queries from the Customers Database using PDO
    $stmt = $db->query($sql);
    $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    //Encoding into json API 
    echo json_encode($customer);

   } 
   catch(PDOException $e){
   	echo '{"error": {"text": '.$e->getMessage().'}';
   	   }
   	});

//Add customer(POST)

$app->post('/api/customer/add',function(Request $request, Response $response){
    
 $first_name = $request->getParam('first_name');
 $last_name = $request->getParam('last_name');
 $email = $request->getParam('email');
 $phone = $request->getParam('phone');
 $address = $request->getParam('addess');
 $city = $request->getParam('city');
 $state = $request->getParam('state');

   $sql = "INSERT INTO customers (first_name,last_name,email,phone,address,city,state) VALUES(:first_name,:last_name,:email,:phone,:address,:city,:state)";

   try{
   	//Get Database Object where db object taken from db.php
   	$db = new db();
   	//Connect
   	$db = $db->connect();

    $stmt = $db->prepare($sql)

    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);  

    $stmt->execute();
    echo '{"notice": {"text": "customer Added"}';

   } 
   catch(PDOException $e){
   	echo '{"error": {"text": '.$e->getMessage().'}';
   	   }
   	});