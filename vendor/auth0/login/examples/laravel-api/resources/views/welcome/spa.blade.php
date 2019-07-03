<!DOCTYPE html>
<html ng-app="sample" ng-controller="AppCtrl">
<head>
    <title ng-bind="pageTitle"></title>

    <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- font awesome from BootstrapCDN -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/app/home/home.css">
    <link rel="stylesheet" type="text/css" href="/app/login/login.css">

    <script type="text/javascript" src="/js/auth0-variables.js"></script>
    <script type="text/javascript" src="https://cdn.auth0.com/js/lock-9.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.17/angular.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.17/angular-cookies.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.17/angular-route.js"></script>
    <script type="text/javascript" src="https://cdn.auth0.com/w2/auth0-angular-4.js"></script>
    <script src="//cdn.rawgit.com/auth0/angular-storage/master/dist/angular-storage.js" type="text/javascript"> </script>
    <script src="//cdn.rawgit.com/auth0/angular-jwt/master/dist/angular-jwt.js" type="text/javascript"> </script>
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/app/home/home.js"></script>
    <script type="text/javascript" src="/app/login/login.js"></script>

<body>
<div class="container" ng-view></div>
</body>
</html>
