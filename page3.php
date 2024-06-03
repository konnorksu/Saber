<?php
    include_once('partials/header.php');
    if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true){
        header('Location: index.php');
    }
?>    
    <main>
    <div class="parallax bg14 w80">
        <?php
                    $email="";
                    $password="";
                            if(isset($_POST['user_login'])){
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $user_object = new User();
                                $user_object->login($email, $password);
                            }
                        ?>
        <form action="" method="POST" class="form1" id="add-form">
        <span>Sign in your account</span>
        <span>or <a href="./register.php" style="text-decoration: none;">register</a> if you don't have one</span> <br>
            <div class="input-box">
                <input data-required="true" type="email" class="input-field" placeholder="Email" name="email" value="<?= $email?>">
            </div>
            <div class="input-box">
                <input data-required="true" type="password" class="input-field" placeholder="Password" name="password" value="<?= $password?>">
            </div>
            <button type="submit" name="user_login" class="send-btn button1">login</button>
        </form>
    </div>
    </main>
<?php
    include_once('partials/footer.php');
?>