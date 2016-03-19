<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Finanças</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="angularjs/angular.js"></script>
        <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.js">
        <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <style>
            .modal-header, h4, .close {
                background-color: #5cb85c;
                color:white !important;
                text-align: center;
                font-size: 30px;
            }
            .modal-footer {
                background-color: #f9f9f9;
            }

            /* Set the fixed height of the footer here */
            #footer {
                background-color: #f5f5f5;
            }

        </style>

        <script>
            var app = angular.module('app', []);
            app.controller('controler', function($scope) {

                $scope.id = 1;
                $scope.listaPessoas = [];
                $scope.meses = [{mes: "Janeiro"},
                                {mes: "Fevereiro"},
                                {mes: "Março"},
                                {mes: "Abril"},
                                {mes: "Maio"},
                                {mes: "Junho"},
                                {mes: "Julho"},
                                {mes: "Agosto"},
                                {mes: "Setembro"},
                                {mes: "Outubro"},
                                {mes: "Novembro"},
                                {mes: "Dezembro"}];

                $scope.data = new Date();

                //ADD
                $scope.add = function (name) {
                    $scope.name = name;
                    $scope.listaPessoas.push({ id: $scope.id , name: name });
                    $scope.id = $scope.id + 1;

                    for(var i = 0; i < $scope.listaPessoas.length; i++ ) {
                        $scope.listaPessoas[i].id = i +1;
                    }
                };

                //REMOVEROW
                $scope.removeRow = function(id){
                    var index = -1;
                    var comArr = eval($scope.listaPessoas);
                    for(var i = 0; i < comArr.length; i++ ) {
                        if(comArr[i].id === id ) {
                            index = i;
                            break;
                        }
                    }
                    if(index === -1 ){
                        alert("Algo de errado não está certo :(");
                    }

                    $scope.listaPessoas.splice(index, 1);

                    for(var i = 0; i < $scope.listaPessoas.length; i++ ) {
                        $scope.listaPessoas[i].id = i +1;
                    }

                };

                //DETALHES
                $scope.detalhes = function(id, name){
                    $scope.id = id;
                    $scope.name = name;
                }

                //Logout
                $scope.logout = function(){
                    window.location.href = "login.php";
                }

                //VALIDATE - validar o valor do campo "Valor da mensalidade" para aceitar apenas números.
                $scope.validate = function (evt) {
                    var theEvent = evt || window.event;
                    var key = theEvent.keyCode || theEvent.which;
                    key = String.fromCharCode( key );
                    var regex = /[0-9]|\./;
                    if( !regex.test(key) ) {
                        theEvent.returnValue = false;
                        if(theEvent.preventDefault) theEvent.preventDefault();
                    }
                }

                //EXECUTA AO CARREGAR A PÁGINA
                angular.element(document).ready(function () {
                });

            });
        </script>

    </head>
    <body ng-app="app" ng-controller="controler">

        <form name="form" method="get" style="padding-top: 5px">

            <!-- Cria os menus -->
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#cadastro">Cadastro</a></li>
                <li><a data-toggle="tab" href="#gerenciamento">Gerenciamento</a></li>
                <li><a data-toggle="tab" href="#lancamentos">Lançamentos</a></li>
                <li><a data-toggle="tab" href="#caixa">Caixa</a></li>
                <li><a data-toggle="tab" href="#configuracoes">Configurações</a></li>
                <button type="button" class="btn btn-default btn-sm" style="margin-right: 7px; margin-top: 2px; float: right" ng-click="logout()">Logout<span class="glyphicon glyphicon-log-out" style="padding-left: 10px"/></button>
                <label style="margin-right: 10px; margin-top: 10px; float: right"><span class="glyphicon glyphicon-time"></span>  {{ data | date:'HH:mm' }}</label>
                <label style="margin-right: 5px; margin-top: 10px; float: right"><span class="glyphicon glyphicon-calendar"></span> {{ data | date:'dd/MM/yyyy' }}</label>
            </ul>

            <div class="tab-content" style="margin-top: 15px">

                <!-- Menu 1 - Cadastro -->
                <div id="cadastro" class="tab-pane fade in active">
                    <div class="container-fluid" >
                        <div>
                            <label>Nome:</label><br>
                            <input type="text" class="form-control" name="name" ng-model="name" style="width: 250px" required>
                            <button type="submit" ng-disabled="!form.name.$valid" class="btn btn-primary" ng-click="add(name)" style="margin-top: 5px">Adicionar</button>
                            <!--<p ng-show="form.name.$invalid && !form.name.$pristine" class="help-block">Nome é obrigatório</p>-->
                        </div>

                        <table class="table table-striped" style="margin-top: 1%">
                            <th>id</th>
                            <th>Nome</th>
                            <th>Adicionado em:</th>
                            <th></th>

                            <tr ng-repeat="n in listaPessoas">
                                <td> {{ n.id }} </td>
                                <td> {{ n.name }} </td>
                                <td> {{ data | date:'dd/MM/yyyy'}} </td>
                                <td>
                                    <input type="button" value="Remover" class="btn btn-danger btn-sm" ng-click="removeRow(n.id)"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Menu 2 - Gerenciamento -->
                <div id="gerenciamento" class="tab-pane fade">

                    <div class="container-fluid" >
                        <input type="text" class="form-control" ng-model="pesquisaGerenciamento" placeholder="Procurar..." style="background-color: #e9e9e9; width: 250px; "/>
                    </div>

                    <div class="container-fluid" style="margin-top: 1%" >
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nome</th>
                                    <th>Adicionado em:</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="n in listaPessoas | filter: pesquisaGerenciamento">
                                    <td> {{ n.id }} </td>
                                    <td> {{ n.name }} </td>
                                    <td> {{ data | date:'dd/MM/yyyy'}} </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" ng-click="detalhes(n.id, n.name)">Detalhes</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal -->
                    <div class="container">
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{ id }} - {{ name }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th ng-repeat="m in meses">
                                                        {{ m.mes }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                    <td style="background-color: white"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="modal-footer">

                                        <div style="float: left">
                                            <button type="button" class="btn btn-sm" style="background-color: #4cae4c"></button> <label> Pago até dia {{ dataLimite }} </label>
                                            <button type="button" class="btn btn-sm" style="background-color: gold"> </button> <label> Pago até ultimo dia do mês </label>
                                            <button type="button" class="btn btn-sm" style="background-color: orangered"> </button> <label> Em atraso </label>
                                        </div>

                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu 3 - Lançamentos-->
                <div id="lancamentos" class="tab-pane fade">

                </div>

                <!-- Menu 4 - Caixa-->

                <div id="caixa" class="tab-pane fade">

                    <div class="container-fluid">
                        <table>
                            <tr>
                                <td style="padding-top: 5px">
                                    <label>Data: </label>
                                </td>

                                <td style="padding-left: 10px; padding-top: 5px">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="width: 25px"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="date" name="dataEntrada" ng-model="dataEntrada" min="2016-01-01" class="form-control" style="width: 165px">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top: 5px">
                                    <label>Descrição: </label>
                                </td>
                                <td style="padding-left: 10px; padding-top: 5px">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="width: 35px"><i class="glyphicon glyphicon-pencil"></i></span>
                                            <input type="text" class="form-control" name="descricaoEntrada" ng-model="descricaoEntrada" style="width: 165px">
                                        </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top: 5px">
                                    <label>Valor: </label>
                                </td>
                                <td style="padding-left: 10px; padding-top: 5px">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="width: 38px">$</span>
                                        <input type="number" name="valorEntrada" ng-model="valorEntrada" class="form-control" style="width: 165px" min="0.0" step="0.10">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>

                                </td>

                                <td style="padding-left: 10px; padding-top: 15px">
                                    <div class="btn-group" data-toggle="buttons">

                                        <label class="btn btn-default" style="width: 102px">
                                            <input type="radio" id="radioEntrada" name="entrada">Entrada
                                        </label>
                                        <label class="btn btn-default" style="width: 102px">
                                            <input type="radio" id="radioSaida" name="saida" value="Saída" style="width: 100px">Saída
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                </td>
                                <td style="padding-left: 10px; padding-top: 15px">
                                    <button type="submit" name="addEntrada" class="btn btn-default btn-block">Adicionar</button>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <hr>

                    <!-- Cria o navbar dentro do menu Caixa -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#entrada">Entrada</a></li>
                        <li><a data-toggle="tab" href="#saida">Saida</a></li>
                    </ul>

                    <!-- Menu Entrada -->
                    <div id="entrada" class="tab-pane fade in active">

                        <div class="container-fluid" style="margin-top: 1%">

                            <input type="text" class="form-control" ng-model="procurarEntrada" placeholder="Procurar..." style="background-color: #e9e9e9; width: 250px"/>

                            <table class="table table-striped" style="width: 20%">

                                <thead>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Menu Saída -->
                    <div id="saida" class="tab-pane fade">

                        <div class="container-fluid" style="margin-top: 1%">

                            <input type="text" class="form-control" ng-model="procurarSaida" placeholder="Procurar..." style="background-color: #e9e9e9; width: 250px"/>

                            <table class="table table-striped" style="width: 20%">

                                <thead>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Menu 5 - Configurações-->
                <div id="configuracoes" class="tab-pane fade">

                    <div class="container-fluid">
                        <table>

                            <tr>
                                <td>
                                    <label>Valor da multa: </label>
                                </td>

                                <td style="padding-left: 10px">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" name="valorMulta" ng-model="valorMulta" class="form-control" style="width: 100px" maxlength="3" min="0.0">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Valor da mensalidade: </label>
                                </td>

                                <td style="padding-left: 10px">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="number" name="valorMensalidade" ng-model="valorMensalidade" class="form-control" style="width: 100px" maxlength="3" min="0.0">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top: 10px">
                                    <label>Data limite para o pagamento: </label>
                                </td>
                                <td style="padding-left: 10px; padding-top: 10px">
                                    <div>
                                        <input type="number" value="1" name="dataLimite" ng-model="dataLimite" min="1" max="31" style="text-align: center; width: 127px">
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

            <div id="footer" class="navbar navbar-fixed-bottom" align="center">
                <p class="text-muted credit" style="padding-top: 10px">© Copyright {{ data | date:'yyyy'}} | <a href="https://www.facebook.com/Maracabarro-FC-919965614713913/?fref=ts" target="_blank" style="color: #ff653c">Maracabarro FC</a></p>
            </div>
        </form>
    </body>
</html>
