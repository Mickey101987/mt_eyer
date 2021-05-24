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
        <a class="nav-link active" href="#"><i class="bi-bicycle"></i> Moto Taxis</a>
    </nav>
</div>

<main class="page-wrapper">
    <div id="wait" style="visibility: hidden; display: none;">
    </div>
    <div class="page-body">
        <div class="panel-container">
            <div class="panel-left">
                <div class="panel-card">
                    <div class="panel-card-header">
                        <table class="options-tab-list table-bordernone">
                            <tbody>
                            <tr>
                                <td class="options-tab-list-col-icon">
                                    <div class="icon-highlight">&nbsp;</div>
                                    <div class="icon-context-32">
                                        <i class="bi-bicycle"></i>
                                    </div>
                                </td>
                                <td class="options-tab-list-col-title">
                                    <div class="title-box">
                                        <div class="menu-name f-18 bold">
                                            <span class="pl-grid-row-count"></span>
                                            <span class="pl-name-span"></span>
                                        </div>
                                    </div>
                                </td>
                                <!--All others-->
                                <td>
                                    <form id="listForm" action="" method="">
                                        <input type="hidden" id="objectClass" name="objectClass" value="Project">
                                        <input type="hidden" id="objectId" name="objectId" value="">
                                        <input type="hidden" id="objectClassList" name="objectClassList"
                                               value="Project">
                                        <table style="width: 100%; height: 35px;">
                                            <tbody>
                                            <tr class="tools-widgets-font-size">
                                                <td width="80%">&nbsp;</td>
                                                <td class="tool-nav-btn" width="36px" tabindex="0"
                                                    data-bs-toggle="tooltip" title="Add new element">
                                                    <a href="#" id="btn-left-add-new-row" class="btn-link f-18"><i
                                                            class="bi-file-earmark-plus-fill"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn" width="36px" tabindex="1"
                                                    data-bs-toggle="tooltip" title="Refresh list">
                                                    <a href="#" id="btn-action-reload-communes-list"
                                                       class="btn-link f-18"><i class="bi-arrow-repeat"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn"
                                                    width="51px"
                                                    data-bs-toggle="popover"
                                                    title="Filtres"
                                                    data-bs-content='<i>
                                                                        <div style="position:relative;left:15px;">
                                                                            Widget inactif.
                                                                        </div>
                                                                    </i>'>
                                                    <a href="#"
                                                       class="btn-link f-18">
                                                        <i class="bi-filter-circle-fill"></i>
                                                    </a>
                                                </td>
                                                <td class="tool-nav-btn"
                                                    width="51px"
                                                    data-bs-toggle="popover"
                                                    title="Cacher les colonnes"
                                                    data-bs-content='<i>
                                                                            <div style="text-align: center;
                                                                                        font-size: 100%;
                                                                                        font-style: italic;
                                                                                        color: #aaaaaa;">
                                                                                Widget inactif.
                                                                            </div>
                                                                        </i>'>
                                                    <a href="#" id="btn-action-column-show" class="btn-link f-18"><i
                                                            class="bi-segmented-nav"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn"
                                                    data-bs-toggle="popover"
                                                    data-bs-content="<div class='list-group'>
                                                    <a href='#' class='list-group-item list-group-item-action'><i class='bi-trash-fill'></i></a>
                                                    <a href='#' class='list-group-item list-group-item-action'><i class='bi-file-pdf-fill'></i></a>
                                                    <a href='#' class='list-group-item list-group-item-action'><i class='bi-file-spreadsheet-fill'></i></a>
                                                    </div>">
                                                    <a href="#" id="btn-more-action" class="btn-link f-18"><i
                                                            class="bi-three-dots-vertical"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn">&nbsp;</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="label-message-empty-table" id="label-message-table"><br>
                            <i>
                                <div style="position:relative;left:15px;">
                                    Aucun taximan trouver.
                                </div>
                            </i>
                        </div>
                    </div>
                    <div class="panel-card-body">
                        <table id="data-list" class="data-get-list table">
                            <thead>
                            <tr>
                                <td>id</td>
                                <td>n&deg; identification</td>
                                <td>nom</td>
                                <td>t&eacute;l&eacute;phone</td>
                                <td>residence</td>
                                <td>n&deg; gilet</td>
                                <td>propri&eacute;taire</td>
                            </tr>
                            </thead>
                            <tbody id="load-data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="splitter"></div>
            <div class="panel-right">
                <div class="panel-card">
                    <div class="panel-card-header button-div">
                        <table class="options-tab-list table-bordernone">
                            <tbody>
                            <tr>
                                <td class="options-tab-list-col-icon">
                                    <div class="icon-highlight">&nbsp;</div>
                                    <div class="icon-context-32">
                                        <i class="bi-bicycle"></i>
                                    </div>
                                </td>
                                <td class="options-tab-list-col-title">
                                    <div class="title-box">
                                        <div class="menu-name f-18 bold">
                                            <span class="object">Taximan</span>
                                            <span class="grid-row-count"></span>
                                            <span class="separator"></span>
                                            <span class="name-span"></span>
                                        </div>
                                    </div>
                                </td>
                                <!--All others-->
                                <td>
                                    <form id="listForm" action="" method="">
                                        <input type="hidden" id="objectClass" name="objectClass" value="Project">
                                        <input type="hidden" id="objectId" name="objectId" value="">
                                        <input type="hidden" id="objectClassList" name="objectClassList"
                                               value="Project">
                                        <table style="width: 100%; height: 35px;">
                                            <tbody>
                                            <tr class="tools-widgets-font-size">
                                                <td width="80%">&nbsp;</td>
                                                <td class="tool-nav-btn" width="36px">
                                                    <a href="#" id="btn-right-add-new-row" class="btn-link f-18"><i
                                                            class="bi-file-earmark-plus-fill"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn" width="36px">
                                                    <a href="#" id="btnActionReloadPlotList" class="btn-link f-18"><i
                                                            class="bi-arrow-repeat"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn" data-bs-toggle="tooltip" title="Enregistrer les modification" width="51px">
                                                    <a href="#" id="btnActionSave" class="btn-link f-18"><i
                                                            class="bi-save-fill"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn" width="51px">
                                                    <a href="#" id="btnActionColumnToShow" class="btn-link f-18"><i
                                                            class="bi-printer-fill"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn">
                                                    <a href="#" id="btnActionColumnToShow" class="btn-link f-18"><i
                                                            class="bi-three-dots-vertical"></i> </a>
                                                </td>
                                                <td class="tool-nav-btn">&nbsp;</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-card-body">
                        <div id="details-box" class="content-pane border-container-pane" style="overflow: hidden; left: 0px; top: 38px; position: absolute; width: 100%; height: calc(100vh - 100px);">
                            <form style="width: 100%; height: calc(100vh - 100px); display: none" id="main-form">
                                <div style="width: 100%; height: 100%">
                                    <div id="details-form-div" class="content-pane" style="width: 100%; height: 100%">
                                        <div id="tab-details-container" class="tab-container layout-container" style="width: 100%; height: calc(100vh - 100px)">
                                            <div id="tab-details-container-tab-list" class="layout-container tab-controller align-top" style="left: 0px; top: 0px; position: absolute; width: 100%; height: 41px;">
                                                <div class="dijitTabInnerDiv dijitTabContent dijitButtonContents dijitbelow-altArrowButton tabStripButton-top dijitAlignRight dijitTab tabStripButton" style="user-select: none; left: 95%; top: 0px; position: absolute; height: 36px;">
                                                    <span class="inline dijitTabStripIcon dijitTabStripMenuIcon"></span>
                                                </div>
                                                <div class="dijitTabInnerDiv dijitTabContent dijitButtonContents tabStripButton-top dijitAlignLeft dijitTab tabStripButton dijitTabDisabled tabStripButtonDisabled dijitDisabled" style="user-select: none; left: 0px; top: 0px; position: absolute; height: 36px;">
                                                    <span class="inline dijitTabStripIcon dijitTabStripSlideLeftIcon"></span>
                                                </div>
                                                <div class="dijitTabInnerDiv dijitTabContent dijitButtonContents tabStripButton-top dijitAlignLeft dijitTab tabStripButton dijitTabDisabled tabStripButtonDisabled dijitDisabled" style="user-select: none; left: 92%; top: 0px; position: absolute; height: 36px;">
                                                    <span class="inline dijitTabStripIcon dijitTabStripSlideRightIcon"></span>
                                                </div>
                                                <div class="dijitTabListWrapper dijitTabContainerTopNone dijitAlignCenter" style="height: 41px; left: 39px; top: 0px; position: absolute; width: 88%;">
                                                    <div class="nowrapTabStrip dijitTabContainerTop-tabs" style="width: 51800px;">
                                                        <div class="dijitTabInner dijitTabContent dijitTab dijitTabChecked dijitChecked" style="display: inline-block">
                                                            <span class="tabLabel" style="user-select: none;" tabindex="0"  aria-disabled="false" title="" aria-selected="true">Description</span>
                                                        </div>
                                                        <div class="dijitTabInner dijitTabContent dijitTab" style="display: inline-block;">
                                                            <span class="tabLabel" style="user-select: none;" tabindex="-1" aria-disabled="false" title="">Dossier</span>
                                                        </div>
                                                        <div class="dijitTabInner dijitTabContent dijitTab" style="display: inline-block;">
                                                            <span class="tabLabel" style="user-select: none;" tabindex="-1" aria-disabled="false" title="">Badge</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane-wrapper tab-container-top-container align-center" style="left: 0; top: 41px; position: absolute; width: 100%; height: calc(100vh - 100px)">
                                                <div class="visible-div">
                                                    <div class="tab-pane content- container-scroll-bar" style="width: 100%; height: calc(100vh - 100px); left: 0; top: 0; overflow: auto">
                                                        <div>
                                                            <div id="commune-description" class="" style="display: inline-block; position: relative; width: 96.9%; float: left; clear: none; margin: 4px 0px 4px 15px; padding: 0px; top: 0px;">
                                                                <div class="title-pane title-pane-title">
                                                                    <span class="arrow-node"></span>
                                                                    <span class="pane-text-node">Description</span>
                                                                </div>
                                                                <div class="title-pane-content-outer">
                                                                    <div class="reset">
                                                                        <div class="title-pane-content-inner">
                                                                            <table class="detail" style="width: 100%">
                                                                                <tbody>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="id">id</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <span style="padding: 1px 5px 5px 5px; font-size: 8pt; height: 50px; color: #AAAAAA" id="index-tr">#</span>
                                                                                        <input type="hidden" id="input-id" name="input-id">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="select-commune">commune</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <div class="digit-text-box input required">
                                                                                            <div class="reset select-container">
                                                                                                <select id="select-commune" class="reset input-select" name="select-commune">
                                                                                                </select>
                                                                                                <span class="select-divider"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="input-identification-number">n&deg; d'identification</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <div class="digit-text-box input required">
                                                                                            <div class="reset input-container">
                                                                                                <input class="reset input-inner" id="input-identification-number" name="input-identification-number" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="input-vest-number">n&deg; gilet</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <div class="digit-text-box input required">
                                                                                            <div class="reset input-container">
                                                                                                <input class="reset input-inner" id="input-vest-number" name="input-vest-number" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="input-name">nom</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <div class="digit-text-box input required">
                                                                                            <div class="reset input-container">
                                                                                                <input class="reset input-inner" id="input-name" name="input-name">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="input-last-name">prenom</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <div class="digit-text-box input">
                                                                                            <div class="reset input-container">
                                                                                                <input class="reset input-inner" id="input-last-name" name="input-last-name">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="input-phone-number">n&deg; t&eacute;l&eacute;phone</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <div class="digit-text-box input required">
                                                                                            <div class="reset input-container">
                                                                                                <input list="region-list" class="reset input-inner" id="input-phone-number" name="input-phone-number">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="select-owner">propri&eacute;taire</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <div class="digit-text-box input required">
                                                                                            <div class="reset select-container">
                                                                                                <select id="select-owner" class="reset input-select" name="select-owner">
                                                                                                    <option value=false>non</option>
                                                                                                    <option value=true>oui</option>
                                                                                                </select>
                                                                                                <span class="select-divider"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="detail">
                                                                                    <td class="label" style="position: relative; width: 182px">
                                                                                        <label for="input-neighborhood">quartier/village de residence</label>
                                                                                    </td>
                                                                                    <td style="width: 532px; height: 37px">
                                                                                        <div class="digit-text-box input">
                                                                                            <div class="reset input-container">
                                                                                                <input class="reset input-inner" id="input-neighborhood" name="input-neighborhood">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="height: 50px"><td></td><td></td></tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="label-message-empty-area" id="label-message"><br>
                                <i>
                                    <div style="position:relative;left:15px;">
                                        Aucun &eacute;l&eacute;ment sélectionn&eacute;.
                                    </div>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--<div id="filter-widget" class="hide">
    <div style="display: table; table-layout: fixed; width: 100%; margin-top: 5px; margin-bottom: 15px">
        <div style="display: table-row">
            <div style="display: table-cell; text-align:right;width:25%">
                <span class="nobr">nom&nbsp;&nbsp;</span>
            </div>
            <div style="display: table-cell; width: 55%">
                <div class="rounded digit-text-box">
                    <input type="text" class="filter">
                </div>
            </div>
            <div style="display: table-cell; vertical-align: middle; text-align: right; width:20%;text-align:right;">
                <div class="form-check form-switch form-control-sm">
                    <input class="form-check-input" type="checkbox" id="enable-filter-by-name">
                </div>
            </div>
        </div>
        <div style="display: table-row">
            <div style="display: table-cell; text-align:right; width:25%">
                <span class="nobr">region&nbsp;&nbsp;</span>
            </div>
            <div style="display: table-cell; width:55%">
                <div class="rounded digit-text-box" >
                    <input type="text" class="filter" list="region-list">
                </div>
            </div>
            <div style="display: table-cell; vertical-align: middle; text-align: right; width:20%;text-align:right;">
                <div class="form-check form-switch form-control-sm">
                    <input class="form-check-input" type="checkbox" id="enable-filter-by-region">
                </div>
            </div>
        </div>
        <div style="display: table-row">
            <div style="display: table-cell; text-align:right;width:25%">
                <span class="nobr">depart&nbsp;&nbsp;</span>
            </div>
            <div style="display: table-cell width: 55%">
                <div class="rounded digit-text-box">
                    <input type="text" class="filter" list="dept-list" autocomplete="off">
                </div>
            </div>
            <div style="display: table-cell; vertical-align: middle; text-align: right; width:20%;text-align:right;">
                <div class="form-check form-switch form-control-sm">
                    <input class="form-check-input" type="checkbox" id="enable-depart-filter">
                </div>
            </div>
        </div>
    </div>
</div>-->

<!-- Scripts -->
<script src="/assets/js/jquery-3.5.1.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/offcanvas.js"></script>
<script src="/assets/js/ckeditor/ckeditor.js"></script>

<script src="/assets/js/fullscreen.js"></script>
<script src="/assets/js/scrollable/perfect-scrollbar.min.js"></script>
<script src="/assets/js/scrollable/scrollable-custom.js"></script>
<script src="/assets/js/jquery-resizable/dist/jquery-resizable.js"></script>
<script src="/assets/js/mt-eyer-dialog.js"></script>
<script src="/assets/js/taximan.js"></script>
<script src="/assets/js/customs-scripts.js"></script>
<!-- Plugins JS Ends-->
<script>
    $(".panel-left").resizable({
        handleSelector: ".splitter",
        resizeHeight: false
    });

    $(".panel-left-2").resizable({
        handleSelector: ".splitter-2",
        resizeHeight: false
    });

    $(".panel-top").resizable({
        handleSelector: ".splitter-horizontal",
        resizeWidth: false
    });

    $("#btnUnbind").on("click",
        function () {
            $(".panel-left").resizable("destroy");
        });
</script>
</body>
</html>
