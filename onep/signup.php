<?php
require_once 'view.php';
require_once 'db_func.php';
require_once 'pers_func.php';
/*
if(is_logged())
    header("location:index.php");
*/


if(is_logged())
    header("location:index.php");

$users = db_select("SELECT * FROM users");
/*if(count($users) == 0)
    header("location:signup.php");
*/


if (isset($_POST["username"])) {

    $username = secure_string($_POST["username"]);
    $password = secure_string($_POST["password"]);
    $repassword= secure_string($_POST["repassword"]);
    $email = secure_string($_POST["email"]);
    if(is_empty($username))  { echo "Veuillez saisi le nom d'utilisateur !"; exit; }
    if(is_empty($password))  { echo "Veuillez saisi le mot de pass !"; exit; }
    if(is_empty($email))  { echo "Veuillez saisi l'email !"; exit; }
    if(strlen($password) < 4)  { echo "Le mot de pass est faible"; exit; }
    if($password != $repassword)  { echo "Le mot de pass pas identique"; exit; }
    if(!is_email($email))  { echo "Email invalid "; exit; }

    if(count($users)>0)
    {
        for ($i=0; $i<count($users); $i++)
        {
            if(strtolower($users[$i]["USERNAME"]) == strtolower($username))
            { echo "Ce nom d'utilisateur déja existe dans la base de donnée"; exit; }
        }
    }

    $password = crypt_pass($password);

    $query = "INSERT INTO `users` (`ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `DATE_INSERT`) 
              VALUES (NULL, '$username', '$password', '$email', NOW())";

   // echo $query;

    if(!db_execute($query))
        echo "Echec de créer un nouveau compte !";

    exit;
}





show_header(false);
?>

            <div id="login" style="height: 530px; margin-top: -265px;">
                <form method="POST" id="signup_form" target="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div id="logo"></div>
                    <hr/>
                    <h3 class="blue align_c">s'inscrire</h3>
                    <div id="alert" style=" margin: 10px auto; text-align: center;"></div>

                    <div class="input">
                        <input type="text" placeholder="Utilisateur" name="username" />
                    </div>
                    <div class="mar_top_20"></div>
                    <div class="input">
                        <input type="password" placeholder="Mot de pass" name="password" />
                    </div>
                    <div class="mar_top_20"></div>
                    <div class="input">
                        <input type="password" placeholder="Saisi a nouveau le mot de pass" name="repassword" />
                    </div>
                    <div class="mar_top_20"></div>
                    <div class="input">
                        <input type="text" placeholder="Saisi votre email" name="email" />
                    </div>
                    <input type="submit" value="Inscrire" id="signup_submit" class="btn-flat">
                    <a href="login.php"><h5 class="blue align_c">Déjà avoir un compte ?</h5></a>
                </form>
            </div>

<?php
show_footer(false);
?>
