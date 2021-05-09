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

if (isset($_POST["N"])) {

    $N = secure_string($_POST["N"]);
    if(is_empty($N))  { echo "Veuillez saisi le numéro du centre !"; exit; }
    $CENTRE = secure_string($_POST["CENTRE"]);
    if(is_empty($CENTRE))  { echo "Veuillez saisi le nom du centre !"; exit; }

    $center_exists = false;
    for ($i=0; $i<count($centres); $i++) {
        if (strtoupper($centres[$i]["N"]) == strtoupper($CENTRE)) {
            $center_exists = true;
            break;
        }
    }
    if($center_exists)
    {
        echo "Le centre est déja exists !";
        exit;
    }

    $query = "INSERT INTO `centres` (`N`, `CENTRE`, `DATE_INSERT`) 
              VALUES ('$N', '$CENTRE', NOW())";

    //echo $query;

    if(!db_execute($query))
        echo "Les informations d'Exp Gen ne sont pas ajoutés";

    exit;
}

show_header();

?>


        <form method="POST" id="centre" target="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h1 class="exo huge text-center blue">AJOUTER NOUVEAU CENTRE</h1>

            <div id="alert" style=" margin: 10px auto; text-align: center;max-width: 700px;"></div>

            <div class="table-responsive center_div" style="max-width: 700px;">
                <table class="table zebra-table table-bordered table-hover" id="table_eg">
                    <thead>
                    <tr>
                        <th style="max-width: 200px;">NUMERO DU CENTRE</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="N°" name="N"/>
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>CENTRE</th>
                        <td>
                            <div class="input">
                                <input type="text" placeholder="CENTRE" name="CENTRE"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input style="max-width: 400px; display: block;" type="submit" name="save_centre" id="save_centre" value="Enregistrer"
                                   class="btn-flat center_div align_c" >
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>

        <div class="mar_top_20"></div>
        <hr/>
        <div class="mar_top_20"></div>

        <div class="center_div" style="max-width: 600px;">
            <h1 class="exo huge text-center blue">LES CENTRES DISPONIBLES</h1>
            <div class="mar_top_20"></div>
            <table class="display table-responsive center_div">
                <thead>
                <tr>
                    <th><span>N°</span></th>
                    <th><span>CENTRE</span></th>
                    <th><span>DATE AJOUTE</span></th>
                    <th><span>SUPPRIMER</span></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th><span>N°</span></th>
                    <th><span>CENTRE</span></th>
                    <th><span>DATE AJOUTE</span></th>
                    <th><span>SUPPRIMER</span></th>
                </tr>
                </tfoot>
                <tbody>
                <?php for ($i = 0; $i < count($centres); $i++): ?>
                    <tr>
                        <td><?php echo $centres[$i]["N"]; ?></td>
                        <td><?php echo $centres[$i]["CENTRE"]; ?></td>
                        <td><?php echo $centres[$i]["DATE_INSERT"]; ?></td>
                        <td><span onclick="remove_record('centre', '<?php echo $centres[$i]["N"]; ?>')"><i class="fa fa-times" title="Supprimer" style="cursor: pointer; color: red;" aria-hidden="true"></i></span></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </div>


<?php
show_footer();

?>