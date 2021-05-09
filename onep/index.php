<?php
/**
 * Created by PhpStorm.
 * User: NMO
 * Date: 10-Jun-17
 * Time: 17:07
 */
require_once 'view.php';


if(!is_logged())
    header("location:login.php");


show_header();

?>
<div id="container" class="container">

    <!-- /.row -->
    <div class="row justify-content-md-center">
        <div class="col-lg-12">
            <h1 class="exo huge text-center blue">SAISI LES DETAILS</h1>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" onclick="window.location = 'immeuble.php?immeuble_type=etat'">
                    <h3 class="text-center white">Branchement Immeubles</h3>
                    <div class="text-right">Etat</div>
                </div>
                <a href="immeuble.php?immeuble_type=etat">
                    <div class="panel-footer">
                        <span class="pull-left">Saisi les details...</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-1x"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" onclick="window.location = 'immeuble.php?immeuble_type=particulier'">
                    <h3 class="text-center white">Branchement Immeubles</h3>
                    <div class="text-right">Particulier</div>
                </div>
                <a href="immeuble.php?immeuble_type=particulier">
                    <div class="panel-footer">
                        <span class="pull-left medi">Saisi les details...</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-1x"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" onclick="window.location = 'eg.php?eg_type=etat'">
                    <h3 class="white text-center ">Exploitation Generale Eau</h3>
                    <div class="text-right">Etat</div>
                </div>
                <a href="eg.php?eg_type=etat'">
                    <div class="panel-footer">
                        <span class="pull-left medi">Saisi les details...</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-1x"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" onclick="window.location = 'eg.php?eg_type=particulier'">
                    <h3 class="text-center white">Exploitation Generale Eau</h3>
                    <div class="text-right">Particulier</div>
                </div>
                <a href="eg.php?eg_type=particulier">
                    <div class="panel-footer">
                        <span class="pull-left medi">Saisi les details...</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-1x"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->



    <div class="row justify-content-md-center">

        <div class="col-lg-3 col-md-6">

        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" onclick="window.location = 'show.php'">
                    <h3 class="text-center"><br/>  Recap <br/> <br/> </h3>
                </div>
                <a href="show.php">
                    <div class="panel-footer">
                        <span class="pull-left medi">Voir plus ...</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-1x"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" onclick="window.location = 'centre.php'">
                    <h3 class="text-center">Les centres <br/> disponibles <br/>  <br/>  </h3>
                </div>
                <a href="centre.php">
                    <div class="panel-footer">
                        <span class="pull-left medi">Voir les centres...</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-1x"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">

        </div>

    </div>
    <!-- /.row -->



</div>
<!-- /.container -->

    <?php

show_footer();

?>
