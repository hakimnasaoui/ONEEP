<?php
/**
 * Created by PhpStorm.
 * User: NMO
 * Date: 10-Jun-17
 * Time: 18:57
 */
require_once "view.php";
require_once "pers_func.php";
require_once "db_func.php";

if(!is_logged())
    header("login.php");

$centres = db_select("SELECT * FROM centres ORDER BY DATE_INSERT DESC");

if (isset($_POST["eg_type"])) {
    $eg_type = secure_string($_POST["eg_type"]);
    if ($eg_type == "etat") {
    } else if ($eg_type == "particulier") {
    } else { echo "Exp Gen type est inconnu !"; exit; }


    $N = (int)($_POST["N"]);
    if($N <= 0)  { echo "Le numéro est erroné !"; exit; }
    $PRODUITE_HT = as_float(secure_string($_POST["PRODUITE_HT"]));
    $FIONEP = as_float(secure_string($_POST["FIONEP"]));
    $VOLUME = as_float(secure_string($_POST["VOLUME"]));
    $VENTE = as_float(secure_string($_POST["VENTE"]));
    $SURTAXE = as_float(secure_string($_POST["SURTAXE"]));
    $TIMBRE = as_float(secure_string($_POST["TIMBRE"]));
    $NET_EG = as_float(secure_string($_POST["NET_EG"]));
    $NET_C_C = as_float(secure_string($_POST["NET_C_C"]));
    $NET_GLOBAL = as_float(secure_string($_POST["NET_GLOBAL"]));
    $NBR = (int)(secure_string($_POST["NBR"]));
    $CENTRE = (secure_string($_POST["CENTRE"]));
    $MOIS = secure_string($_POST["MOIS"]);
    @list($m, $y) = @explode("/", $MOIS);
    $m = (int)$m;
    $y = (int)$y;
    if ($m < 1 || $m > 12) {
        echo "Le mois est erroné !";
        exit;
    }
    if ($y < 1970 || $y > 2100) {
        echo "L'année est erronée !";
        exit;
    }

    $center_exists = false;
    for ($i=0; $i<count($centres); $i++) {
        if (strtoupper($centres[$i]["N"]) == strtoupper($CENTRE)) {
            $center_exists = true;
            break;
        }
    }
    if(!$center_exists)
    {
        echo "Le centre n'est pas exists !";
        exit;
    }


    $query = "INSERT INTO `eg` (`ID`, `N`, `PRODUITE_HT`, `FIONEP`, `VOLUME`, `VENTE`, `SURTAXE`, `TIMBRE`, 
                            `NET_EG`, `NET_C_C`, `NET_GLOBAL`, `NBR`, `CENTRE`, `MOIS`, `ANNEE`,`EG_TYPE`, `DATE_INSERT`) 
              VALUES (NULL, $N, $PRODUITE_HT, $FIONEP, $VOLUME, $VENTE, $SURTAXE, $TIMBRE, 
              $NET_EG, $NET_C_C, $NET_GLOBAL, $NBR, '$CENTRE', $m, $y, '$eg_type', NOW())";

    //echo $query;

    if(!db_execute($query))
        echo "Les informations d'Exp Gen ne sont pas ajoutés";

    exit;
}

$eg_type = @$_GET["eg_type"];
show_header();

?>

        <?php if(strtoupper($eg_type) != "ETAT" && strtoupper($eg_type) != "PARTICULIER")
                echo "<div class=\"alert alert-danger fade in\" style=\" margin: 10px auto; text-align: center;max-width: 700px;\">
                    Exp Gen type est inconnu ! 
                    <br/>
                    <b><a href='index.php'>page d'Acceuil</a></b>
                    </div>";
        else
        {
        ?>
        <form method="POST" id="eg" target="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h1 class="exo huge text-center blue">SAISI LES DETAILS DU EXP. GEN
                (<?php echo @strtoupper($eg_type); ?>) </h1>

            <div id="alert" style=" margin: 10px auto; text-align: center;max-width: 700px;"></div>

            <div class="table-responsive center_div" style="max-width: 700px;">
                <table class="table zebra-table table-bordered table-hover" id="table_eg">
                    <tbody>
                    <tr>
                        <th style="max-width: 200px;">N°</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="N°" name="N"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>PRODUITE HT</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="PRODUITE HT" name="PRODUITE_HT"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>FIONEP</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="FIONEP" name="FIONEP"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>VOLUME</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="VOLUME" name="VOLUME"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>VENTE</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="VENTE" name="VENTE"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>SURTAXE</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="SURTAXE" name="SURTAXE"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>TIMBRE</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="TIMBRE" name="TIMBRE"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>NET EG</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="NET EG" name="NET_EG"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>NET C C</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="NET C C" name="NET_C_C"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>NET GLOBAL</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="NET GLOBAL" name="NET_GLOBAL"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>NBR</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="NBR" name="NBR"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>CENTRE</th>
                        <td>
                            <div class="form-group" style="margin: 0 auto;">
                                <div>
                                    <select id="CENTRE" name="CENTRE" class="form-control">
                                    <?php
                                        for($i=0; $i<count($centres); $i++)
                                            echo '<option value="'.$centres[$i]["N"].'">'.$centres[$i]["CENTRE"].'</option>';
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>MOIS</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="MOIS" name="MOIS"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input style="max-width: 400px; display: block;" type="submit" name="save_eg" id="save_eg" value="Enregistrer"
                                   class="btn-flat center_div align_c" >
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="eg_type" value="<?php echo @$_GET["eg_type"]; ?>">
            </div>
        </form>
        <?php } ?>

<?php
show_footer();

?>