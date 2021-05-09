<?php
require_once 'pers_func.php';

function show_header($with_nav=true)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="icon" href="favicon.ico" type="image/x-icon">
            <link href="css/font-awesome.min.css" rel="stylesheet">
            <link href="css/bootstrap.css" rel="stylesheet">
            <link href="css/jquery.dataTables.css" rel="stylesheet">
            <link href="css/sb-admin-2.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="css/style.css">

        </head>
        <body>
            <div id="fundo">
                <?php if($with_nav) { ?>
                <nav class="navbar navbar-default">
                    <div class="container">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="index.php">
                                <b class="blue">O.N.E.P</b>
                            </a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li <?php if(strtolower(basename($_SERVER['PHP_SELF'])) == "index.php" ) echo 'class="active"'; ?>><a href="index.php">Acceuil</a></li>
                            <li class="dropdown <?php if(strtolower(basename($_SERVER['PHP_SELF'])) == "eg.php" ) echo 'active'; ?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Saisi Exp.Gen <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="eg.php?eg_type=etat">Etat</a></li>
                                    <li><a href="eg.php?eg_type=particulier">Particulier</a></li>
                                </ul>
                            </li>
                            <li class="dropdown <?php if(strtolower(basename($_SERVER['PHP_SELF'])) == "immeuble.php" ) echo 'active'; ?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Saisi immeuble <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="immeuble.php?immeuble_type=etat">Etat</a></li>
                                    <li><a href="immeuble.php?immeuble_type=particulier">Particulier</a></li>
                                </ul>
                            </li>
                            <li <?php if(strtolower(basename($_SERVER['PHP_SELF'])) == "show.php" ) echo 'class="active"'; ?>><a href="show.php">Recap</a></li>
                            <li <?php if(strtolower(basename($_SERVER['PHP_SELF'])) == "centre.php" ) echo 'class="active"'; ?>><a href="centre.php">Centres</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if(!is_logged()) { ?>
                            <li><a href="signup.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Créer nouveau compte</a></li>
                            <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Connecter</a></li>
                            <?php } else { ?>
                            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnecter</a></li>
                            <?php }  ?>
                        </ul>
                    </div>
                </nav>
            <?php } else { ?>
            <div class="container">
            <?php } ?>

        <?php
}

function show_footer($show_copy=true)
{

                if($show_copy) :
    ?>
                    <div style="margin-top: 20px">
                        <p class="text-muted text-center" style="display:block;">Copyright © 2017 <b>ONEP</b></p>
                    </div>
                <?php endif; ?>
                </div>
            </div>

            <script src="js/jquery-3.2.1.min.js"></script>
            <script src="js/bootstrap.js"></script>
            <script src="js/jquery.dataTables.js"></script>
            <script src="js/script.js"></script>
        </body>
    </html>

    <?php
}


function show_eg_result($result, $eg_type)
{
    ?>
    <table class="display table-responsive center_div">
        <thead>
        <tr>
            <th><span>CLIENT</span></th>
            <th><span>CENTRE</span></th>
            <th><span>N°</span></th>
            <th><span>PRODUITE HT</span></th>
            <th><span>FIONEP</span></th>
            <th><span>VOLUME</span></th>
            <th><span>VENTE</span></th>
            <th><span>SURTAXE</span></th>
            <th><span>TIMBRE</span></th>
            <th><span>NET EG</span></th>
            <th><span>NET C C</span></th>
            <th><span>NET GLOBAL</span></th>
            <th><span>NBR</span></th>
            <th><span>MOIS</span></th>
            <th><span>SUPPRIMER</span></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th><span>CLIENT</span></th>
            <th><span>CENTRE</span></th>
            <th><span>N°</span></th>
            <th><span>PRODUITE HT</span></th>
            <th><span>FIONEP</span></th>
            <th><span>VOLUME</span></th>
            <th><span>VENTE</span></th>
            <th><span>SURTAXE</span></th>
            <th><span>TIMBRE</span></th>
            <th><span>NET EG</span></th>
            <th><span>NET C C</span></th>
            <th><span>NET GLOBAL</span></th>
            <th><span>NBR</span></th>
            <th><span>MOIS</span></th>
            <th><span>SUPPRIMER</span></th>
        </tr>
        </tfoot>

        <tbody>
        <?php for ($i = 0; $i < count($result); $i++): ?>
            <tr id="record_row_<?php echo $result[$i]["ID"]; ?>">
                <td><?php echo $result[$i]["EG_TYPE"]; ?></td>
                <td><?php echo get_center_caption($result[$i]["CENTRE"]); ?></td>
                <td><?php echo $result[$i]["N"]; ?></td>
                <td><?php echo round_it($result[$i]["PRODUITE_HT"], 2); ?></td>
                <td><?php echo round_it($result[$i]["FIONEP"], 2); ?></td>
                <td><?php echo $result[$i]["VOLUME"]; ?></td>
                <td><?php echo round_it($result[$i]["VENTE"], 2); ?></td>
                <td><?php echo round_it($result[$i]["SURTAXE"], 2); ?></td>
                <td><?php echo round_it($result[$i]["TIMBRE"], 2); ?></td>
                <td><?php echo round_it($result[$i]["NET_EG"], 2); ?></td>
                <td><?php echo round_it($result[$i]["NET_C_C"], 2); ?></td>
                <td><?php echo round_it($result[$i]["NET_GLOBAL"], 2); ?></td>
                <td><?php echo $result[$i]["NBR"] ?></td>
                <td><?php echo $result[$i]["MOIS"] . "/" . $result[$i]["ANNEE"]; ?></td>
                <td><span onclick="remove_record('eg', '<?php echo $result[$i]["ID"]; ?>')"><i class="fa fa-times" title="Supprimer" style="cursor: pointer; color: red;" aria-hidden="true"></i></span></td>
            </tr>
        <?php endfor; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3"><span><i>TOTAL :</i> </span></th>
            <th><span><?php echo round_it(sum_col($result, "PRODUITE_HT"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "FIONEP"), 2);?></span></th>
            <th><span><?php echo (int)(sum_col($result, "VOLUME"));?></span></th>
            <th><span><?php echo round_it(sum_col($result, "VENTE"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "SURTAXE"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "TIMBRE"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "NET_EG"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "NET_C_C"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "NET_GLOBAL"), 2);?></span></th>
            <th><span></span></th>
            <th><span></span></th>
            <th><span></span></th>
        </tr>
        </tfoot>
    </table>
<?php
}



function show_immeuble_result($result, $eg_type)
{
    ?>
    <table class="display table-responsive center_div">
        <thead>
        <tr>
            <th><span>CLIENT</span></th>
            <th><span>CENTRE</span></th>
            <th><span>N°</span></th>
            <th><span>F BRANCH</span></th>
            <th><span>FIONEP</span></th>
            <th><span>F BRANCHEMENT_TTC</span></th>
            <th><span>FI TTC</span></th>
            <th><span>NET TTC</span></th>
            <th><span>NBR</span></th>
            <th><span>MOIS</span></th>
            <th><span>SUPPRIMER</span></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th><span>CLIENT</span></th>
            <th><span>CENTRE</span></th>
            <th><span>N°</span></th>
            <th><span>F BRANCH</span></th>
            <th><span>FIONEP</span></th>
            <th><span>F BRANCHEMENT_TTC</span></th>
            <th><span>FI TTC</span></th>
            <th><span>NET TTC</span></th>
            <th><span>NBR</span></th>
            <th><span>MOIS</span></th>
            <th><span>SUPPRIMER</span></th>
        </tr>
        </tfoot>
        <tbody>
        <?php for ($i = 0; $i < count($result); $i++): ?>
            <tr>
                <td><?php echo $result[$i]["IMMEUBLE_TYPE"]; ?></td>
                <td><?php echo get_center_caption($result[$i]["CENTRE"]); ?></td>
                <td><?php echo $result[$i]["N"]; ?></td>
                <td><?php echo round_it($result[$i]["F_BRANCH"], 2); ?></td>
                <td><?php echo round_it($result[$i]["FIONEP"], 2); ?></td>
                <td><?php echo round_it($result[$i]["F_BRANCHEMENT_TTC"], 2); ?></td>
                <td><?php echo round_it($result[$i]["FI_TTC"], 2); ?></td>
                <td><?php echo round_it($result[$i]["NET_TTC"], 2); ?></td>
                <td><?php echo $result[$i]["NBR"]; ?></td>
                <td><?php echo $result[$i]["MOIS"] . "/" . $result[$i]["ANNEE"]; ?></td>
                <td><span onclick="remove_record('immeuble', '<?php echo $result[$i]["ID"]; ?>')"><i class="fa fa-times" title="Supprimer" style="cursor: pointer; color: red;" aria-hidden="true"></i></span></td>
            </tr>
        <?php endfor; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3"><span><i>TOTAL :</i> </span></th>
            <th><span><?php echo round_it(sum_col($result, "F_BRANCH"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "FIONEP"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "F_BRANCHEMENT_TTC"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "FI_TTC"), 2);?></span></th>
            <th><span><?php echo round_it(sum_col($result, "NET_TTC"), 2);?></span></th>
            <th><span></span></th>
            <th><span></span></th>
            <th><span></span></th>
        </tr>
        </tfoot>
    </table>
    <?php
}

?>