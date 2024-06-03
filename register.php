<?php
    include_once('partials/header.php');
  $user_object = new User();
  if(isset($_POST['user_register'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if($password === $confirm_password){
      if($user_object->register($email, $password)){
        echo "<p> Registracia uspeshna</p>";

      }
      else{
        echo "<p> Registracia zlyhala</p>";
      }
    }
      else{
        echo "<p> Hesla sa nezhoduju</p>";
      }
    }
  
?> 
<main>
        <div class="parallax bg01">
          <div class="content-in-parallax right">
              <h1>Registrácia</h1>
              <form action="" method="POST">
                    <label for="email">E-mail:</label>
                    <br>
                    <input type="email" id="email" name="email" required>
                    <br>
                    <label for="password">Heslo:</label>
                    <br>
                    <input type="password" id="password" name="password" required>
                    <br>
                    <label for="confirm_password">Zopakovať heslo:</label>
                    <br>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <br>
                    <button type="submit" name="user_register">Registrovať sa</button>
              </form>
          </div>
        </div>
    </main>
    
<?php
    include_once('partials/footer.php')
?>