

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="input form.css" />
</head>

<body>
  <div class="wrapper">
    <div id="main">
      <div id="pictureside">
        <!-- <button id="backbutton">&#x2B05; Back</button> -->
      </div>
      <div id="formside">
        <div id="logo"><img src="logo.png" alt="Logo" /><span id="title">NoteCloud</span></div>
        <fieldset id="or">
          <legend id="hd">Join with Us</legend>
        </fieldset>
        <form action="input form.php" method="GET">
          <fieldset class="inputs">
            <legend>Enter username</legend>
            <input type="text" name="checkusername" id="id" placeholder="eg: user1234" />
          </fieldset>

          <fieldset class="inputs pass">

            <legend>Password</legend>
            <input type="password" name="checkpass" id="password" placeholder="Enter your password" />

          </fieldset>
          <input type="text" name="mode" id="mod"/>
          <button id="signin" type="submit">Log In</button>
        </form>
        <span id="donthaveacc"><span id="donthvtext">Dont have an account?</span> <strong id="togglemode">Sign
            Up</strong></span>
        <div id="copyright">
          Copyright &#169; 2021, Razan&Shittal. All Rights Reserved.
        </div>
      </div>
    </div>
  </div>
</body>
<?php








if(isset($_GET['checkusername'])){

$uname=$_GET['checkusername'];
$pass=$_GET['checkpass'];
$mode=$_GET['mode'];


$encoded_uname=urlencode($uname);
$encoded_pass=urlencode($pass);

$target_url="http://localhost/razan-project/db-api.php?uname=$encoded_uname&passc=$encoded_pass";

$response=file_get_contents($target_url);
echo "<script>
console.log('$response');
</script>";

// response "0" or "1";


  if($response=="1" || $mode=="s"){
//check datanase  for username and password
echo "<script>
localStorage.setItem('username','".$uname."');
localStorage.setItem('password','".$pass."');
window.location.href='notesapp.php';
</script>";
  }else{
   echo "<script>
   document.querySelector('#hd').textContent='Incorrect username or password';
   document.querySelector('#hd').classList.add('red');
   
   </script>";

  }

}



?>
<script>
  
  let fmode;
  const tbtn = document.querySelector("#togglemode");
  let modelement=document.querySelector("#mod");
  if (tbtn.textContent == "Sign Up") {
    fmode = "s";
  } else {
    fmode = "l";
  }
  modelement.value=fmode;
  tbtn.addEventListener("click", (e) => {
    if (fmode == "s") {
      fmode = "l";
      document.querySelector("#donthvtext").textContent = "Dont have an account?";
      tbtn.textContent = "Sign Up";
      document.querySelector("#signin").textContent = "Log In";
      document.querySelector("#pictureside").style.backgroundImage = "url('welcome-back.png')";
    } else {
      fmode = "s";
      document.querySelector("#donthvtext").textContent = "Already have an account?";
      tbtn.textContent = "Log In";
      document.querySelector("#signin").textContent = "Sign Up";
      document.querySelector("#pictureside").style.backgroundImage = "url('welcome2.avif')";


    }
  modelement.value=fmode;
  });
</script>








</html>