<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Finanças</title>
        <script src="angularjs/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.js">
        <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap-modal.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script>
            var app = angular.module('app', []);
            app.controller('controler', function($scope) {
                $scope.data = new Date();

                $scope.submitForm = function(isValid, login) {

                    if (isValid && login == true) {
                        window.location.href = "index.php";
                    } else if(login == false){
                        window.location.href = "novaConta.php";
                    }

                };

            });

        </script>
    </head>

    <body ng-app="app" ng-controller="controler">

        <div class="navbar navbar-fixed-top" role="navigation" style="margin-left: 20px; margin-right: 20px; margin-top: 15px" align="right">
            <span class="glyphicon glyphicon-calendar"></span> {{ data | date:'dd/MM/yyyy'}}
            <span class="glyphicon glyphicon-time " style="padding-left: 10px"></span> {{ data | date:'HH:mm'}}
        </div>

        <div class="container" style="margin-top: 10%">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header" style="padding:35px 50px;">
                        <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
                    </div>

                    <div class="modal-body" style="padding:40px 50px;">

                        <form name="form" action="loginCheck.jsp">

                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="usuario" ng-model="usuario" type="text" placeholder="Usuário" required>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input class="form-control" name="senha" ng-model="senha" type="password" placeholder="Senha" required>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-warning btn-block" ng-disabled="form.$invalid" ng-click="submitForm(form.$valid, true)">Login <span class="glyphicon glyphicon-off"></span></button>
                            <button type="button" class="btn btn-warning btn-block" ng-click="submitForm(form.$valid, false)">Criar conta <span class="glyphicon glyphicon-hand-right"></span></button>

                        </form>
                    </div>
                </div>

                <br>

                <div id="footer" class="navbar navbar-fixed-bottom" align="center">
                    <p class="text-muted credit" style="padding-top: 10px">© Copyright {{ data | date:'yyyy'}} | <a href="https://www.facebook.com/Maracabarro-FC-919965614713913/?fref=ts" target="_blank" style="color: #ff653c">Maracabarro FC</a></p>
                </div>                
            </div>
        </div>
    </body>
</html>