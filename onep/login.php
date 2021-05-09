<?php
require_once 'view.php';
require_once 'db_func.php';
require_once 'pers_func.php';

if(is_logged())
    header("location:index.php");


$users = db_select("SELECT * FROM users");
/*if(count($users) == 0)
    header("location:signup.php");
*/


if (isset($_POST["username"])) {

    $username = secure_string($_POST["username"]);
    $password = secure_string($_POST["password"]);
    if(is_empty($username))  { echo "Veuillez saisi le nom d'utilisateur !"; exit; }
    if(is_empty($password))  { echo "Veuillez saisi le mot de pass !"; exit; }
    if(strlen($password) < 4)  { echo "Mot de pass invalid"; exit; }

    if(count($users)>0)
    {
        for ($i=0; $i<count($users); $i++)
        {
            if(strtolower($users[$i]["USERNAME"]) == strtolower($username))
            {
                if(check_crypted_pass_correct($password, $users[$i]["PASSWORD"]))
                {
                    $_SESSION["USER"]["USERNAME"] =  $users[$i]["USERNAME"];
                    $_SESSION["USER"]["EMAIL"] =  $users[$i]["EMAIL"];
                    $_SESSION["USER"]["ID"] =  $users[$i]["ID"];
                    exit;
                   // header("Location:index.php");
                }
                else
                    { echo "Vérifier votre mot de pass !"; exit; }
            }
        }
        { echo "Vérifier votre nom d'utilisateur!"; exit; }
    }
    else
    { echo "Aucun utilisateur dans la base de donnée !"; exit; }
}
show_header(false);
?>

<div id="login" style="height: 460px; margin-top: -230px;">
    <form method="POST" id="login_form" target="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div id="logo"></div>
        <hr/>
        <h3 class="blue align_c">Se connecter</h3>
        <div id="alert" style=" margin: 10px auto; text-align: center;"></div>

        <div class="input">
            <input type="text" placeholder="Utilisateur" name="username" />
        </div>
        <div class="mar_top_20"></div>
        <div class="input">
            <input type="password" placeholder="Mot de pass" name="password" />
        </div>
        <div class="mar_top_20"></div>
        <input type="submit" value="Connecter" id="login_submit" class="btn-flat">
<a href="signup.php"><h5 class="blue align_c">Crée nouveau compte</h5></a>
    </form>
</div>

<?php
show_footer(false);
?>
