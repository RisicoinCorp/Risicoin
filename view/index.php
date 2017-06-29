<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RSC | </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="css/style.css">

  <!-- jQuery 3.1.1 -->
  <script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- WYSHTML5 -->
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- FLOT CHARTS -->
  <script src="plugins/flot/jquery.flot.min.js"></script>
  <script src="plugins/flot/jquery.flot.time.min.js"></script>
  <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
  <script src="plugins/flot/jquery.flot.resize.min.js"></script>

  <script>
    /**
     * Appelle un modal avec paramètres dont warning/success
     */
    function callmodal(type, title, body) {
      if(type == "warning") {
        $("#call-warning").removeClass("modal-success").addClass("modal-warning");
      } else if(type == "success") {
        $("#call-warning").removeClass("modal-warning").addClass("modal-success");
      }
      $("#call-warning .modal-title").text(title);
      $("#call-warning .modal-body").text(body);
      $("#call-warning").modal("show");
    }

    $(function () {
      //éditeur WYSIHTML5 pour mails
      $("#compose-textarea").wysihtml5();

      //envoi mail POST
      $("#submitmail").click(function() {
        var objet = $("#objetmail").val(); 
        var to = $("#pseudomail").val();
        var text = $("#compose-textarea").val();

        if(objet == "" || to == "" || text == "") {
          callmodal("warning", "Erreur dans la rédaction", "Veuillez entrer un objet, un destinataire et un texte.");
        } else {
          //TODO
          /*
          $.post("index.php", {
            post: "submitmail",
            objet: objet,
            to: to,
            text: text
          });
          
          envoi ajax page + csrf
          réponse si erreur modal warning
          sinon modal success
          */
        }
      });

      //Delete account
      $("#confirm-delete").click(function() {
        var pass = $("#pass-delete-account").val();
        if(pass == "") {
          callmodal("warning", "Erreur", "Veuillez entrer votre mot de passe");
        } else {
          // TODO
          /*
          envoi ajax sans oublier token csrf
          réponse si erreur modal warning
          sinon modal success puis cliquer confirmer puis recharger page (déconnexion)
          */
        }
      });

      //Change pass
      $("#changepassbutton").click(function() {
        var input1 = $("#changepass").val(),
            input2 = $("#changepassnew").val(),
            input3 = $("#validformchange").val();

        if(input1 == "" || input2 == "" || input3 == "") {
          callmodal("warning", "Erreur", "Veuillez entrer votre mot de passe actuel, le nouveau et une confirmation du nouveau.");
        } else if(input2!=input3) {
          callmodal("warning", "Erreur", "Le nouveau mot de passe et la confirmation doivent être similaires.");
        } else {
          //TODO
        }
      });

      //Change profile
      $("#changeprofile").click(function(e) {
        e.preventDefault();

        var input1 = $("#changemail").val(),
            input2 = $("#changepaypal").val(),
            input3 = $("#changetextprofile").val(),
            input4 = $("#changeavatar").val();

        if(input1 == "") {
          callmodal("warning", "Erreur", "Vous devez entrer votre adresse mail !");
          //Le reste n'est pas nécessaire
        } else {
          //TODO
        }
      });

      //Flot chart
      var data = [
        [(new Date(2017, 4, 21)), 0],
        [(new Date(2017, 4, 22)), 0],
        [(new Date(2017, 4, 23)), 0],
        [(new Date(2017, 4, 24)), 0],
        [(new Date(2017, 4, 25)), 0],
        [(new Date(2017, 4, 26)), 0],
        [(new Date(2017, 4, 27)), 0],
        [(new Date(2017, 4, 28)), 0],
        [(new Date(2017, 4, 29)), 0],
        [(new Date(2017, 4, 30)), 0],
        [(new Date(2017, 4, 31)), 0],
        [(new Date(2017, 5, 1)), 0],
        [(new Date(2017, 5, 2)), 0],
        [(new Date(2017, 5, 3)), 0],
        [(new Date(2017, 5, 4)), 0],
        [(new Date(2017, 5, 5)), 0],
        [(new Date(2017, 5, 6)), 0],
        [(new Date(2017, 5, 7)), 0],
        [(new Date(2017, 5, 8)), 0],
        [(new Date(2017, 5, 9)), 0],
        [(new Date(2017, 5, 10)), 0],
        [(new Date(2017, 5, 11)), 0],
        [(new Date(2017, 5, 12)), 0],
        [(new Date(2017, 5, 13)), 0],
        [(new Date(2017, 5, 14)), 0],
        [(new Date(2017, 5, 15)), 0],
        [(new Date(2017, 5, 16)), 1],
        [(new Date(2017, 5, 17)), 2],
        [(new Date(2017, 5, 18)), 0],
        [(new Date(2017, 5, 19)), 0],
        [(new Date(2017, 5, 20)), 2]
      ];

      var options = {
        grid: {
          borderColor: "#f3f3f3",
          borderWidth: 1,
          tickColor: "#f3f3f3"
        },
        series: {
          shadowSize: 0,
          color: "#C13100"
        },
        lines: {
          fill: true,
          color: "#3c8dbc"
        },
        yaxis: {
          min: 0,
          max: 10,
          show: true
        },
        xaxis: {
          show: true,
          mode: "time",
          dayNames: ["dim", "lun", "mar", "mer", "jeu", "ven", "sam"],
          monthNames: ["jan", "fév", "mar", "avr", "mai", "juin", "juil", "aoû", "sep", "oct", "nov", "déc"]
        }
      };

      var interactive_plot = $.plot("#lastvisits", [data], options);
    });
  </script>

</head>
 
<body class="hold-transition skin-orange layout-boxed sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <a href="/" class="logo">
        <span class="logo-mini">RSC</span>
        <span class="logo-lg">RSC</span>
      </a>

      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- menu header -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">1</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Tu as 1 message</li>
                <li>
                  <ul class="menu">
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/default-50x50.gif" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Admin
                          <small><i class="fa fa-clock-o"></i> 5 min</small>
                        </h4>
                        <p>Bienvenue sur RSC ! Merci de ton inscrip...</p> <!-- 40 caractères maximum -->
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="footer"><a href="#">Voir tous les messages</a></li>
              </ul>
            </li>
            <!-- fin messages -->

            <!-- menu notifs -->
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-danger">1</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Tu as 1 notification</li>
                <li>
                  <ul class="menu">
                    <li>
                      <a href="#">
                        <i class="fa fa-info text-aqua"></i> Ouverture du site !
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="footer"><a href="#">Voir toutes les notifications</a></li>
              </ul>
            </li>
            <!-- fin notifs -->

            <!-- menu déconnecter -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="dist/img/boxed-bg.jpg" class="profile-image" alt="User Image">
                <span class="hidden-xs">profile</span>
              </a>
              <div class="dropdown-menu logout-btn">
                    <a href="#" class="btn btn-default btn-flat">Se déconnecter</a>
              </div>
            </li>
          </ul>
        </div>
        <!-- fin menu header-->

      </nav>

    </header>

    <aside class="main-sidebar">
      <section class="sidebar">

        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/boxed-bg.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>profile</p>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Gestion du profil</li>
          <li class="active">
            <a href="#profil"><i class="fa fa-user"></i><span>Profil</span></a>
          </li>
          <li>
            <a href="#mp"><i class="fa fa-envelope"></i>
              <span>Messages privés</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">1</small>
              </span>
            </a>
          </li>

          <li class="header">Site</li>
          <li>
            <a href="#"><i class="fa fa-line-chart"></i><span>Cours du clic</span></a>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-credit-card"></i><span>Banque</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Créditer le compte</a></li>
              <li><a href="#">Payer en RSC</a></li>
            </ul>
          </li>
        </ul>

      </section>
    </aside>

    <div class="content-wrapper">

      <section class="content-header">
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> /</a></li>
          <li class="active">Profil</li>
        </ol>
      </section>

      <section class="content body">
        
      <h2 class="page-header">
        <a href="#profil" id="profil">Profil</a>
      </h2>

      <!-- gestion profil -->
      <div class="row">
        <div class="col-md-5">
          <div class="box box-primary-orange">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive picture-rsc" src="dist/img/default-50x50.gif" alt="User profile picture">

              <h3 class="profile-username text-center">profile</h3>

              <blockquote class="blockquote text-muted">message d'accueil personnel lorem ipsum dolor sit amet lorem... ipsum dolor !</blockquote> <!-- si pas de msg d'accueil enrgstr mettre une indication-->

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>RSC</b> <a class="pull-right">0,0405</a>
                </li>
                <li class="list-group-item">
                  <b>Visites totales</b> <a class="pull-right">543</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="box box-primary-orange">
            <div class="box-header with-border">
              <h3 class="box-title">Dernières visites</h3>
            </div>
            <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  20/06 à 18 h 35 <span class="pull-right">+ 0,001 RSC</span>
                </li>
                <li class="list-group-item">
                  20/06 à 18 h 30 <span class="pull-right">+ 0,001 RSC</span>
                </li>
                <li class="list-group-item">
                  17/06 à 5 h 48 <span class="pull-right">+ 0,0008 RSC</span>
                </li>
                <li class="list-group-item">
                  17/06 à 14 h 04 <span class="pull-right">+ 0,0008 RSC</span>
                </li>
                <li class="list-group-item">
                  16/06 à 16 h 52 <span class="pull-right">+ 0,00075 RSC</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="box box-solid box-danger">
            <div class="box-header">
              <i class="icon fa fa-exclamation-triangle"></i> Supprimer le compte
            </div>
            <div class="box-body">
              <form role="form">
                <div class="input-group">
                  <input class="form-control" id="pass-delete-account" placeholder="Entrez votre mot de passe actuel" type="password">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#accout-delete">Envoyer</button>
                  </div>
                </div>
                <p class="help-block">Cette action est irréversible</p>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="box box-primary-orange">
            <div class="box-header with-border">
              <h3 class="box-title">Modifier le profil</h3>
            </div>
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="changemail">E-mail</label>
                  <input class="form-control" id="changemail" placeholder="Entrez un e-mail" value="abcd@efgh.com" type="email">
                </div>
                <div class="form-group">
                  <label for="changepaypal"><img src="dist/img/credit/paypal2.png" alt="Paypal"> Adresse Paypal</label>
                  <input class="form-control" id="changepaypal" placeholder="Entrez votre adresse Paypal" type="email">
                  <p class="help-block">Pour demander un virement</p>
                </div>
                <div class="form-group">
                  <label for="changetextprofile">Changer votre message d'accueil</label>
                  <textarea class="form-control" id="changetextprofile" placeholder="Entrez un texte">message d'accueil personnel lorem ipsum dolor sit amet lorem... ipsum dolor !</textarea>
                  <p class="help-block">Votre message d'accueil sera affiché sur votre page de visite</p>
                </div>
                <div class="form-group">
                  <label for="changeavatar">Changer l'avatar</label>
                  <input id="changeavatar" type="file">

                  <div class="box box-solid box-warning box-form-margin">
                    <div class="box-header">
                      <i class="icon fa fa-warning"></i> Attention
                    </div>
                    <div class="box-body">
                      Le fichier doit être de type jpeg, jpg, png ou gif et doit faire moins de 500 Ko !
                    </div>
                  </div>
                </div>
              </div>

              <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary-orange" id="changeprofile">Valider</button>
              </div>
            </form>
            <!-- end form -->
          </div>

          <div class="box box-primary-orange">
            <div class="box-header with-border">
              <h3 class="box-title">Modifier le mot de passe</h3>
            </div>
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="changepass">Ancien mot de passe</label>
                  <input class="form-control" id="changepass" type="password" minlength="8">
                </div>
                <div class="form-group">
                  <label for="changepassnew">Nouveau mot de passe</label>
                  <input class="form-control" id="changepassnew" type="password" minlength="8">
                </div>
                <div class="form-group">
                  <label for="validformchange">Confirmez votre nouveau mot de passe</label>
                  <input class="form-control" id="validformchange" type="password" minlength="8">
                </div>
              </div>

              <div class="box-footer text-center">
                <button type="button" class="btn btn-primary-orange" id="changepassbutton">Valider</button>
              </div>
            </form>
            <!-- end form -->
          </div>
        </div>
      </div>
      <!-- flot chart-->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary-orange">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i> <h3 class="box-title">Dernières visites <small>Visites en fonction de la date</small></h3>
            </div>
            <div class="box-body">
              <div id="lastvisits" style="height: 300px;"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- fin bloc profil-->

      <h2 class="page-header margin-top">
        <a href="#mp" id="mp">Messagerie</a>
      </h2>

        <!-- table messagerie -->
        <div class="row">
          <div class="col-md-12">
          <div class="box box-primary-orange">
            <div class="box-header with-border">
              <h3 class="box-title">Boîte de réception</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input class="form-control input-sm" placeholder="Chercher un mail" type="text">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                </div>
                <!-- /.btn-group -->
                <div class="pull-right">
                  1-1/1
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr>
                    <td class="mailbox-checkbox"><input type="checkbox" /></td>
                    <td class="mailbox-name"><a href="#">Admin</a></td>
                    <td class="mailbox-subject">
                      <b>Bienvenue sur RSC !</b> - Merci de ton inscription, lorem ipsum dolor sit amet...
                    </td>
                    <td class="mailbox-date">5 min</td>
                    <td class="mailbox-info"><small class="label bg-green"><i class="fa fa-exclamation-circle"></i></small></td>
                  </tr>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                </div>
                <!-- /.btn-group -->
                <div class="pull-right">
                  1-1/1
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        </div>
        <!-- fin table messagerie -->

        <!-- envoyer message -->
        <div class="row">
            <div class="col-md-12">
            <div class="box box-primary-orange">
              <div class="box-header with-border">
                <h3 class="box-title">Envoyer un message</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row box-body">
                  <div class="col-md-9">
                    <input class="form-control" id="objetmail" placeholder="Objet" />
                  </div>
                  <div class="col-md-3">
                    <input class="form-control" id="pseudomail" placeholder="Pseudo" />
                  </div>
                </div>
                <div class="form-group">
                      <textarea id="compose-textarea" class="form-control" style="height: 300px"></textarea>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="row">
                  <div class="col-md-2 col-md-offset-10">
                    <button type="button" id="submitmail" class="btn btn-primary-orange"><i class="fa fa-envelope-o"></i> Envoyer</button>
                  </div>
                </div>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row fin bloc envoi message -->

        <div class="modal modal-danger fade" id="accout-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Supprimer le compte</h4>
              </div>
              <div class="modal-body">
                <p>Êtes-vous sûr de supprimer votre compte ?<br />Cette action ne peut être annulée.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-outline" id="confirm-delete" data-dismiss="modal">Confirmer</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.modal danger -->

        <div class="modal modal-warning fade" id="call-warning">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Continuer</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.modal calling -->

      </section>

    </div>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        RSC | footer
      </div>
      <strong>A propos</strong>
    </footer>

</div>

</body>
</html>