<?php
 header('Content-Type: application/json');


$user=$_POST['user'];
// $user="user1"; ////delete later
$pass=$_POST['pass'];
$action=$_POST['action'];
$notehead=$_POST['notehead'];
$notebody=$_POST['notebody'];




$servername="localhost";
$username="root";
$password="";
$database="mydb1";
$conn= new mysqli($servername,$username,$password,"",3306);
// echo json_encode(["head"=>"con err"]);
// $conn->close();
if($conn->connect_error){
  echo json_encode(["head"=>"con err"]);

  die("Connection failed");
}

$myquery="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'";
$result=$conn->query($myquery);

//created database
if($result->num_rows>0){
  $conn->query("USE mydb1");


//auth
if (isset($_GET['uname'])) {
  $uname=urldecode($_GET['uname']);
$passc=urldecode($_GET['passc']);
$sql = "SELECT * FROM users  WHERE username = '$uname' AND password='$passc'"; 
$res = $conn->query($sql);
if ($res->num_rows > 0) {
$response="1";
echo $response;
}else{

  $response="0";
  echo $response;
}


}




if($action=='s'){
  $sql = "SELECT * FROM users  WHERE username = '$user'"; //condition for only one user 
$res = $conn->query($sql);

if ($res) {
    if ($res->num_rows > 0) {

      $rows=array();
      while($row=mysqli_fetch_assoc($res)){
        $rows[]=$row;
      }
        // $data = $res->fetch_assoc();
        $data=$rows;
        echo json_encode( $data);



    } else {
        echo json_encode(array("response" => "No data found"));
    }
} else {
    echo json_encode(array("Error" => $conn->error));
}
}

else if ($action=="i") {
  // echo json_encode(array("response" => "'$user' '$pass' '$action' '$notehead' '$notebody'"));

 $sql="INSERT INTO users (username, PASSWORD, notehead, notebody) VALUES ('$user','$pass','$notehead','$notebody')";
 $res = $conn->query($sql);
 if($res){
  echo json_encode(array("insertresponse" => "1"));
 }else{
  echo json_encode(array("insertresponse" => "0"));

 }

  //delete the data
}
elseif($action=='d'){
  $id=$notehead;
  $sql="DELETE FROM users WHERE id='$id'";
  $res=$conn->query($sql);
  if($res){
    echo json_encode(array("deleteresponse" => "1"));
   }else{
    echo json_encode(array("deleteresponse" => "0"));
  
   }




}else{
  // echo json_encode(["head"=>"Databaseexists"]);

}


  
}


//no created database
    else{
      if (isset($_GET['uname'])) {
        $response="1";
echo $response;
      }

  $myquery = "CREATE DATABASE mydb1";
  if ($conn->query($myquery) == TRUE) {
      $conn->query("USE mydb1");
      $sql = "CREATE TABLE users (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          username VARCHAR(50) NOT NULL,
          PASSWORD VARCHAR(100),
          notehead VARCHAR(10000),
          notebody VARCHAR(1000)
      )";
  
      if ($conn->query($sql) == TRUE) {
          $conn->query("INSERT INTO users (username, password, notehead, notebody) VALUES ('user1', 'pass1', 'head1', 'body1')");
          $conn->query("INSERT INTO users (username, password, notehead, notebody) VALUES ('user2', 'pass2', 'head2', 'body2')");

          echo json_encode(["head" => "Created"]);
      } else {
          echo json_encode(["head" => "Not Created: " . $conn->error]);
      }
  } else {
      echo json_encode(["head" => "Database not created: " . $conn->error]);
  }
  
  
  // echo json_encode(["head"=>"Databasedoesntexist"]);


}








// if(isset($_GET['checkusername'])){

//   $uname=$_GET['checkusername'];
//   $pass=$_GET['checkpass'];
//   $mode=$_GET['mode'];

//   $conn->query("USE mydb1");

//     $sql = "SELECT * FROM users  WHERE username = '$uname' AND passworrd = '$pass'"; 
//   $res = $conn->query($sql);
  
//   if ($res) {
//       if ($res->num_rows > 0) {

//   // check datanase  for username and password
//   echo "<script>
//   localStorage.setItem('username','".$uname."');
//   localStorage.setItem('pass','".$pass."');
//   window.location.href='notesapp.php';
  
//   </script>";
//     }else{
//       if(mode=="s"){
//      echo "<script>
//      document.querySelector('#hd').textContent='Incorrect username or password';
//      document.querySelector('#hd').classList.add('red');
     
//      </script>";
//       }else{
//         echo "<script>
//   localStorage.setItem('username','".$uname."');
//   localStorage.setItem('pass','".$pass."');
//   window.location.href='notesapp.php';
//   </script>";
//       }
//     }
  
//   }
// }



// if (isset($_GET['uname'])) {
//   $uname=urldecode($_GET['uname']);
// $pass=urldecode($_GET['passc']);
// // $mod=urldecode($_GET['mode']);
// // $response="r: $uname and $pass";
// }















// echo $response;















// $notes=[["head"=>$user.$pass.$action,"body"=>"This is body"],["head"=>"This is second head","body"=>"This is second body"]];




//  $response=['notes'=>$notes];


$conn->close();



//  echo json_encode($notes);
?>
