/**
 * Created by NMO on 13-Jun-17.
 */

$("#save_eg").click(function(){

    //alert("dsqdq");
   // if(typeof form_id !== 'undefined') return false;
    var formSelector = "#eg";
    var dataString = $(formSelector).serializeArray();
    $.ajax({
        type: "POST",
        url: "eg.php",
        data: dataString,
        success:function(rep)
        {
            //alert(rep + " - ");
            if(rep.length>0)
            {
                $("#alert").slideDown(300).html("<b>" + rep + '</b>').attr("class", "alert alert-danger fade in");
            }
            else
            {
                $("#alert").slideDown(300).html("<b> Les informations d'Exp Gen sont ajoutés avec succès </b>").attr("class", "alert alert-success fade in");
                document.getElementById("eg").reset();
            }

            setTimeout(function() {
                $('#alert').slideUp(500).html("").removeClass();
            }, 4000); // <-- time in milliseconds
        },
        error:function(xhr, textStatus, errorThrown)
        {
            $("#alert").html("<b> Erreur </br>" + ( errorThrown ? errorThrown : xhr.status ) + '</b>').attr("class", "alert alert-danger fade in");
            alert('Erreur !' + ( errorThrown ? errorThrown : xhr.status ));
        }
    });
    return false;
});


$("#save_immeuble").click(function(){

    //alert("dsqdq");
    // if(typeof form_id !== 'undefined') return false;
    var formSelector = "#immeuble";
    var dataString = $(formSelector).serializeArray();
    $.ajax({
        type: "POST",
        url: "immeuble.php",
        data: dataString,
        success:function(rep)
        {
            //alert(rep + " - ");
            if(rep.length>0)
            {
                $("#alert").slideDown(300).html("<b>" + rep + '</b>').attr("class", "alert alert-danger fade in");
            }
            else
            {
                $("#alert").slideDown(300).html("<b> Les informations du branchement immeuble sont ajoutés avec succès </b>").attr("class", "alert alert-success fade in");
                document.getElementById("immeuble").reset();
            }

            setTimeout(function() {
                $('#alert').slideUp(500).html("").removeClass();
            }, 4000); // <-- time in milliseconds
        },
        error:function(xhr, textStatus, errorThrown)
        {
            $("#alert").html("<b> Erreur </br>" + ( errorThrown ? errorThrown : xhr.status ) + '</b>').attr("class", "alert alert-danger fade in");
            alert('Erreur !' + ( errorThrown ? errorThrown : xhr.status ));
        }
    });
    return false;
});




$("#save_centre").click(function(){

    //alert("dsqdq");
    //if(typeof form_id !== 'undefined') return false;
    var formSelector = "#centre";
    var dataString = $(formSelector).serializeArray();
    $.ajax({
        type: "POST",
        url: "centre.php",
        data: dataString,
        success:function(rep)
        {
            //alert(rep + " - ");
            if(rep.length>0)
            {
                $("#alert").slideDown(300).html("<b>" + rep + '</b>').attr("class", "alert alert-danger fade in");
            }
            else
            {
                $("#alert").show().html("<b> Le centre a été ajoutés avec succès </b>").attr("class", "alert alert-success fade in");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
                //document.getElementById("eg").reset();
            }
            setTimeout(function() {
                $('#alert').slideUp(500);
            }, 3000); // <-- time in milliseconds
        },
        error:function(xhr, textStatus, errorThrown)
        {
            $("#alert").html("<b> Erreur </br>" + ( errorThrown ? errorThrown : xhr.status ) + '</b>').attr("class", "alert alert-danger fade in");
            alert('Erreur !' + ( errorThrown ? errorThrown : xhr.status ));
        }
    });
    return false;
});


$("#search").click(function(){
//alert("dfsf");
    //if(typeof form_id !== 'undefined') return false;
    var formSelector = "#search_form";
    var dataString = $(formSelector).serializeArray();
    $.ajax({
        type: "POST",
        url: "show.php",
        data: dataString,
        success:function(rep)
        {
            $("#alert").html("").removeClass();

            //alert(rep + " - ");
            if( rep.toLowerCase().indexOf('<table') >= 0)
            {
                $("#result").html(rep);
            }
            else
            {
                $("#alert").html("<b>" + rep + '</b>').attr("class", "alert alert-danger fade in");
                //document.getElementById("eg").reset();
            }

           $(document).ready(function() {
                $('.display').DataTable( {
                    "pagingType": "full_numbers"
                } );
           } );

        },
        error:function(xhr, textStatus, errorThrown)
        {
            $("#alert").html("<b> Erreur </br>" + ( errorThrown ? errorThrown : xhr.status ) + '</b>').attr("class", "alert alert-danger fade in");
            alert('Erreur !' + ( errorThrown ? errorThrown : xhr.status ));
        }
    });
    return false;
});




$("#signup_submit").click(function(){

    //alert("dsqdq");
    var formSelector = "#signup_form";
    var dataString = $(formSelector).serializeArray();
    $.ajax({
        type: "POST",
        url: "signup.php",
        data: dataString,
        success:function(rep)
        {
            //alert(rep + " - ");
            if(rep.length>0)
            {
                $("#alert").slideDown(300, function () {
                    $("#login").height(function (index, height) {
                        return (530 +  $("#alert").height());
                    });
                }).html("<b>" + rep + '</b>').attr("class", "alert alert-danger fade in");
            }
            else
            {
                window.location = "index.php";
            }
            setTimeout(function() {
                $('#alert').slideUp(500, function () {
                    $("#login").css("height",530);
                });
            }, 4000); // <-- time in milliseconds
        },
        error:function(xhr, textStatus, errorThrown)
        {
            $("#alert").html("<b> Erreur </br>" + ( errorThrown ? errorThrown : xhr.status ) + '</b>').attr("class", "alert alert-danger fade in");
            alert('Erreur !' + ( errorThrown ? errorThrown : xhr.status ));
        }
    });
    return false;
});



$("#login_submit").click(function(){

    //alert("dsqdq");
    var formSelector = "#login_form";
    var dataString = $(formSelector).serializeArray();
    $.ajax({
        type: "POST",
        url: "login.php",
        data: dataString,
        success:function(rep)
        {
            //alert(rep + " - ");
            if(rep.length>0)
            {
                $("#alert").slideDown(300, function () {
                    $("#login").height(function (index, height) {
                        return (460 +  $("#alert").height());
                    });
                }).html("<b>" + rep + '</b>').attr("class", "alert alert-danger fade in");
            }
            else
            {
                window.location = "index.php";
            }
            setTimeout(function() {
                $('#alert').slideUp(500, function () {
                    $("#login").css("height",460);
                });
            }, 4000); // <-- time in milliseconds
        },
        error:function(xhr, textStatus, errorThrown)
        {
            $("#alert").html("<b> Erreur </br>" + ( errorThrown ? errorThrown : xhr.status ) + '</b>').attr("class", "alert alert-danger fade in");
            alert('Erreur !' + ( errorThrown ? errorThrown : xhr.status ));
        }
    });
    return false;
});


function remove_record(t, id) {
    //alert("dsqdq");
    //var formSelector = "#suspend_form";
    var dataString = [];
    if(typeof t !== 'undefined' && typeof id !== 'undefined')
    {
        t = t.toLowerCase();
        dataString.push({ name: "op", value: "del"});
        dataString.push({ name: "id", value: id});
        if(t === "eg")
            dataString.push({ name: "t", value: "eg"});
        else if(t === "immeuble")
            dataString.push({ name: "t", value: "immeuble"});
        else if(t === "centre")
            dataString.push({ name: "t", value: "centre"});
        else
            return false;
    }
    else
        return false;
    $.ajax({
        type: "POST",
        url: "del.php",
        data: dataString,
        resetForm: false,
        success:function(rep)
        {
           // alert(rep);
            if(rep.length>0)
            {
                $("#alert").html("<b>" + rep + '</b>').attr("class", "alert alert-danger fade in");
            }
            else
            {
                $("#record_row_"+id).html("").remove(500);
            }
            if(t === "centre")
                window.location.reload();
            else
                $('#search').click();
            setTimeout(function() {
                $('#alert').slideUp(500);
            }, 4000); // <-- time in milliseconds
        },
        error:function(xhr, textStatus, errorThrown)
        {
            //$("#search_result").hide().html('').html(( errorThrown ? errorThrown : xhr.status ))
            alert('حدث خطأ ما ! ' + ( errorThrown ? errorThrown : xhr.status ));
        }
    });
    return false;

}



$(document).ready(function() {
    $('.display').DataTable( {
        "pagingType": "full_numbers"
    } );
} );