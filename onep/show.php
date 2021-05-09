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

//is_logged()


if(!is_logged())
    header("location:login.php");


$centres = db_select("SELECT * FROM centres ORDER BY DATE_INSERT DESC");

if (isset($_POST["q"])) {
    $q = @strtolower(secure_string($_POST["q"]));
    $type = @strtoupper(secure_string($_POST["t"]));
    $mois = @secure_string($_POST["m"]);
    $centre = @secure_string($_POST["c"]);
   // echo $q . " - t=$type - mois = $mois - centre = $centre";

    if ($q != "eg" && $q != "immeuble") { echo "Le type est érroné"; exit; }


    $mois_sql = "";
    if(strtolower($mois) == "tous")
    {
        $mois_sql = " ID > 0 ";
    }
    else
    {
        @list($m, $y) = @explode("/", $mois);
        $m = (int)$m;
        $y = (int)$y;
        if ($m < 1 || $m > 12) {
            echo "Le mois est érroné !";
            exit;
        }
        if ($y < 1970 || $y > 2100) {
            echo "L'année est érronée !";
            exit;
        }
        $mois_sql = " MOIS = $m AND ANNEE = $y ";
    }

    $type_sql = "";
    if ($type == "ETAT" || $type == "PARTICULIER") {
        $type_sql = " AND LOWER(" . strtoupper($q) . "_TYPE) = LOWER('$type') ";
    }



    $centre_sql = "";
    $center_exists = false;
    for ($i=0; $i<count($centres); $i++) {
        if (strtoupper($centres[$i]["N"]) == strtoupper($centre)) {
            $center_exists = true;
            break;
        }
    }
    if($center_exists)
    {
        $centre_sql = " AND CENTRE = '$centre' ";
    }

    $query = "SELECT * FROM  $q WHERE $mois_sql $type_sql $centre_sql ORDER BY DATE_INSERT DESC";
    //echo $query;
    $result = db_select($query);

    if ($q == "eg")
        show_eg_result($result, $type);
    else if ($q == "immeuble")
        show_immeuble_result($result, $type);

    exit;
}

$eg_type = @$_GET["eg_type"];
show_header();

?>
    <div class="container">

        <form method="POST" id="search_form" target="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h1 class="exo huge text-center blue">Chercher ...</h1>

            <div id="alert" style=" margin: 10px auto; text-align: center;max-width: 700px;"></div>

            <div class="table-responsive center_div" style="max-width: 700px;">
                <table class="table zebra-table table-bordered table-hover" id="table_eg">
                    <tbody>
                    <tr>
                        <th style="max-width: 200px;">Choisir le type*</th>
                        <td>
                            <div class="form-group" style="margin: 0 auto;">
                                <div>
                                    <select name="q" class="form-control">
                                        <option value="eg">EXPLOIATATION GENERALE EAU (E.G)</option>
                                        <option value="immeuble">BRANCHEMENT IMMEUBLES</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Choisir le mois*</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="saisi 'tous' pour tous les dates" name="m"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="max-width: 200px;">Choisir le client</th>
                        <td>
                            <div class="form-group" style="margin: 0 auto;">
                                <div>
                                    <select name="t" class="form-control">
                                        <option value="_tous_">Tous les clients</option>
                                        <option value="etat">ETAT</option>
                                        <option value="particulier">PARTICULIER</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="max-width: 200px;">Choisir le centre</th>
                        <td>
                            <div class="form-group" style="margin: 0 auto;">
                                <div>
                                    <select name="c" class="form-control">
                                        <option value="_tous_">Tous les centres</option>
                                        <?php
                                        for ($i = 0; $i < count($centres); $i++)
                                            echo '<option value="' . $centres[$i]["N"] . '">' . $centres[$i]["CENTRE"] . '</option>';
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input style="max-width: 400px; display: block;" type="submit" name="search"
                                   id="search" value="Chercher"
                                   class="btn-flat center_div align_c">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>

        <div class="center_div">
            <h1 class="exo huge text-center blue">Resultat du recherche</h1>
            <div class="mar_top_20"></div>

            <div id="result"></div>
        </div>

        <div class="mar_top_20"></div>
    </div>

<?php
show_footer();

?>