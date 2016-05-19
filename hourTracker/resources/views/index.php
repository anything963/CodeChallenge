<!DOCTYPE html>
<html lang=""en-US">
    <head>
        <title>Hour Tracker</title>
        <meta charset="utf-8" />

        <!-- Style sheets -->
        <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= asset('css/toastr.min.css') ?>" rel="stylesheet">
        <link href="<?= asset('css/app.css') ?>" rel="stylesheet">

        <!--Library scripts-->
        <script src="<?= asset('js/jquery.min.js') ?>"></script>
        <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
        <script src="<?= asset('app/lib/angular/angular-ui-router.min.js') ?>"></script>
        <script src="<?= asset('app/lib/angular/angular-animate.min.js') ?>"></script>
        <script src="<?= asset('app/lib/angular/ui-utils.min.js') ?>"></script>
        <script src="<?= asset('app/lib/angular/ui-bootstrap.min.js') ?>"></script>
        <script src="<?= asset('app/lib/angular/ui-bootstrap-tpls.min.js') ?>"></script>
        <script src="<?= asset('app/lib/toastr.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script>

        <!--application-->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/loginController.js') ?>"></script>
        <script src="<?= asset('app/controllers/hourTrackerController.js') ?>"></script>

    </head>
    <body ng-app="hourTracker">
        <div ui-view></div>

    </body>
</html>