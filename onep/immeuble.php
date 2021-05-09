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
    header("location:login.php");

$centres = db_select("SELECT * FROM centres ORDER BY DATE_INSERT DESC");

if (isset($_POST["immeuble_type"])) {
    $immeuble_type = secure_string($_POST["immeuble_type"]);
    if ($immeuble_type == "etat") {
    } else if ($immeuble_type == "particulier") {
    } else { echo "Branchement immeuble type est inconnu !"; exit; }


    $N = (int)($_POST["N"]);
    if($N <= 0)  { echo "Le numéro est erroné !"; exit; }
    $F_BRANCH = as_float(secure_string($_POST["F_BRANCH"]));
    $FIONEP = as_float(secure_string($_POST["FIONEP"]));
    $F_BRANCHEMENT_TTC = as_float(secure_string($_POST["F_BRANCHEMENT_TTC"]));
    $FI_TTC = as_float(secure_string($_POST["FI_TTC"]));
    $NET_TTC = as_float(secure_string($_POST["NET_TTC"]));
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


    $query = "INSERT INTO `immeuble` (`ID`, `N`, `F_BRANCH`, `FIONEP`, `F_BRANCHEMENT_TTC`, `FI_TTC`, `NET_TTC`,
                                `NBR`, `CENTRE`, `MOIS`, `ANNEE`,`IMMEUBLE_TYPE`, `DATE_INSERT`) 
              VALUES (NULL, $N, $F_BRANCH, $FIONEP, $F_BRANCHEMENT_TTC, $FI_TTC, $NET_TTC, 
                      $NBR, '$CENTRE', $m, $y, '$immeuble_type', NOW())";

    //echo $query;

    if(!db_execute($query))
        echo "Les informations d'Exp Gen ne sont pas ajoutés";

    exit;
}

$immeuble_type = @$_GET["immeuble_type"];
show_header();

?>

        <?php if(strtoupper($immeuble_type) != "ETAT" && strtoupper($immeuble_type) != "PARTICULIER")
            echo "<div class=\"alert alert-danger fade in\" style=\" margin: 10px auto; text-align: center;max-width: 700px;\">
                    Branchement immeuble type est inconnu ! 
                    <br/>
                    <b><a href='index.php'>page d'Acceuil</a></b>
                    </div>";
        else
        {
            ?>
            <form method="POST" id="immeuble" target="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <h1 class="exo huge text-center blue">SAISI LES DETAILS DU EXP. GEN
                    (<?php echo @strtoupper($immeuble_type); ?>) </h1>

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
                            <th>F BRANCH</th>
                            <td>
                                <div class="input">
                                    <input type="text" placeholder="F BRANCH" name="F_BRANCH"/>
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
                            <th>F BRANCHEMENT TTC</th>
                            <td>
                                <div class="input">
                                    <input type="text" placeholder="F BRANCHEMENT TTC" name="F_BRANCHEMENT_TTC"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>FI TTC</th>
                            <td>
                                <div class="input">
                                    <input type="text" placeholder="FI TTC" name="FI_TTC"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>NET TTC</th>
                            <td>
                                <div class="input">
                                    <input type="text" placeholder="NET TTC" name="NET_TTC"/>
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
                                <input style="max-width: 400px; display: block;" type="submit" name="save_immeuble" id="save_immeuble" value="Enregistrer"
                                       class="btn-flat center_div align_c" >
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="immeuble_type" value="<?php echo @$_GET["immeuble_type"]; ?>">
                </div>
            </form>
        <?php } ?>

<?php
show_footer();

?>