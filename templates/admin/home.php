<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="BakaTech">
    <title>MT_Eyer - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons -->
    <link href="/assets/css/bootstrap-icons.css" rel="stylesheet">

    <style>
        body.dark-only {
            color: rgba(255, 255, 255, 0.6);
            background-color: #1d1e26
        }

        body.dark-only .card {
            background-color: #262932
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="/assets/css/offcanvas.css" rel="stylesheet">
    <link href="/assets/css/customs-stylesheet.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-toolbar" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MT_Eyer Administration</a>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="offcanvas"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav mb-2 mb-lg-0 me-lg-5">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#"><i class="bi-translate"></i> FR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"><i class="bi-x-diamond-fill"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mode" href="#"><i class="bi-moon-fill"></i> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="toggleFullScreen()"><i class="bi-fullscreen"></i> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="#" id="user-options-popover"
                   data-bs-toggle="popover"
                   data-bs-content="<div class='list-group'>
                <a href='#' class='list-group-item list-group-item-action'><i class='bi-person-fill'></i> Profile</a>
                <a href='#' class='list-group-item list-group-item-action'><i class='bi-gear-fill'></i> Settings</a>
                <a href='#' class='list-group-item list-group-item-action'><i class='bi-box-arrow-in-left'></i> Logout</a>
                </div>">
                    <i class="bi-person-fill"></i> User</a>
            </li>
        </ul>
    </div>
</nav>

<div class="nav-scroller sub-context-nav">
    <nav class="nav nav-underline" aria-label="Secondary navigation">
        <a class="nav-link" href="/admin/communes"><i class="bi-bank2"></i> Commune</a>
        <a class="nav-link" aria-current="page" href="/admin/agents">
            <i class="bi-people-fill"></i> Agents Communales
        </a>
        <a class="nav-link" href="/admin/taximen"><i class="bi-bicycle"></i> Moto Taxis</a>
    </nav>
</div>

<main class="page-wrapper">
    <div id="wait" style="visibility: hidden; display: none;">
    </div>
    <div class="page-body" style="overflow: hidden">
        <div id="helper-block" class="content-pane" style="left: 0px; top: 0; position: absolute; width: 100%; height: 538px;">
            <div style="overflow: auto; padding: 10px; left: 0; top: 0; position: absolute; width: 100%; height:538px" class="container-scroll-bar">
                <div class="title-pane title-pane-title">
                    <span class="arrow-node"></span>
                    <span class="pane-text-node">Guide de d&eacute;marrage</span>
                </div>
                <div class="title-pane-content-outer">
                    <div class="reset">
                        <div class="title-pane-content-inner">
                            <div style="height: 100%; padding: 10px; overflow: auto; position: relative" class="">
                                <div class="title-help-1">Guide de d&eacute;marrage</div>

                                <br>Voici une petite page d'aide pour faciliter votre prise en main de MT_Eyer Administration.<br>
                                Suivez les quelques étapes ci-après pour configurer vos premiers éléments.<br>
                                Pour réafficher cet aide, accédez simplement à la page 'Home'.<br><br>
                                <table style="width:75%">
                                    <tbody>
                                    <tr class="title-help-2"><td colspan="4"><b>Définissez les premiers éléments de "Paramètres environnementaux"</b></td>
                                    </tr>
                                    <tr><td colspan="4"><br></td></tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Créer des Communes</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-bank2"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal; padding-left: 10px" valign="middle">
                                            Les communes sont les entités avec lesquelles vous travaillez.<br>
                                            Une commune represente un territoire dans lequelle est gerer un groupe de taximen motos.
                                        </td>
                                    </tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Créer des Agents Communaux</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-people-fill"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal;padding-left: 10px" valign="middle">
                                            Les agents communaux sont les entités qui travaillent pour une commune donner.<br>
                                           Les agents communaux sont les ressources affecter par une commune pour l'enregistrement des taximen motos.
                                        </td>
                                    </tr>
                                    <tr class="title-help-2"><td colspan="4"><b>Les differents bouttons </b></td>
                                    </tr>
                                    <tr><td colspan="4"><br></td></tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Ajoutez un enregistrement</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-file-earmark-plus-fill"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal; padding-left: 10px" valign="middle">
                                            Ce boutton permet d'ouvrir un formulaire pour ajoutez un nouveau enregistrement.
                                        </td>
                                    </tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Enregistrer vos modifications</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-save2-fill"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal;padding-left: 10px" valign="middle">
                                            Permet de sauvegarder vos modifications.
                                        </td>
                                    </tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Imprimer</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-printer-fill"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal;padding-left: 10px" valign="middle">
                                            Imprimer les donn&eacute;es.
                                        </td>
                                    </tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Actualisez la liste</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-arrow-repeat"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal;padding-left: 10px" valign="middle">
                                           Recharger la liste des resultat du volet gauche.
                                        </td>
                                    </tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Filtrez les resultats</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-filter-circle-fill"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal;padding-left: 10px" valign="middle">
                                            Permet de filtrer la liste de resultats de gauche selon des crit&egrave;res.
                                        </td>
                                    </tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Colonnes &agrave; afficher</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-segmented-nav"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal;padding-left: 10px" valign="middle">
                                            Afficher ou cacher des colonnes.
                                        </td>
                                    </tr>
                                    <tr style="padding:0;margin:0;white-space:nowrap" valign="top">
                                        <td class="title-help-2" style="text-align:right;" valign="middle">&nbsp;&nbsp;&nbsp;Options supplementaires</td>
                                        <td style="position: relative; width:50px" valign="middle">&nbsp;&nbsp;&nbsp;
                                            <span style="cursor:pointer; position: relative; top: -6px; margin-left:10px;">
                                                <div class="icon-context-32" style="z-index:500;width:32px;height:32px;color: #4d4d80" title="">&nbsp;
                                                    <i class="bi-three-dots-vertical"></i>
                                                </div>
                                            </span>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td colspan="2" style="white-space:normal;padding-left: 10px" valign="middle">
                                            Voir les autres options.
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                Voilà pour les principales fonctionnalités.
                                <br>Une fois que vous serez familiarisés avec ces fonctions, vous pourrez couvrir toute l’étendue de votre gestion des taximan motos.<br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Scripts -->
<script src="/assets/js/jquery-3.5.1.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/offcanvas.js"></script>

<script src="/assets/js/fullscreen.js"></script>
<script src="/assets/js/scrollable/perfect-scrollbar.min.js"></script>
<script src="/assets/js/scrollable/scrollable-custom.js"></script>
<script src="/assets/js/mt-eyer-dialog.js"></script>
<script>
    function loadData() {

    }
</script>
<script src="/assets/js/customs-scripts.js"></script>
<!-- Plugins JS Ends-->

</body>
</html>
