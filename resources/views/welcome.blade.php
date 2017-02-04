@extends('layouts.default')

@section('on-page-scripts')

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script>
    var app = angular.module('ProductApp', []);

    app.controller('ProductController', function($scope, $http) {

        $scope.products = [];

        $scope.initProduct = function() {
            $scope.product = {
                name:'',
                quantity:'',
                price:''
            };
        };

        $scope.init = function() {
            $http.get('/products').then(function(response) {
                $scope.products = response.data;
            });
        }

        $scope.addProduct = function() {
            $http.post('/products', $scope.product).then(function(response) {
                $scope.products = response.data;
                $scope.initProduct();
            });
        };

        $scope.getTotal = function(){
            var total = 0;
            for(var i = 0; i < $scope.products.length; i++){
                var product = $scope.products[i];
                total += (product.price * product.quantity);
            }
            return total;
        }

        $scope.init();
        $scope.initProduct();

    });
</script>

@stop

@section('content')
    <h1>Laravel Product Test</h1>
    <div ng-app="ProductApp" ng-controller="ProductController">
        <form ng-submit="addProduct()">
            <div class="form-group">
                <label for="exampleInputEmail1">Product Name</label>
                <input type="text" class="form-control" id="product_name" placeholder="Product Name" ng-model="product.name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Quantity</label>
                <input type="number" class="form-control" id="quantity" placeholder="Quantity" ng-model="product.quantity">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Price per Item</label>
                <input type="number" class="form-control" id="price" placeholder="Price per Item" ng-model="product.price">
            </div>
            <button type="submit" class="btn btn-default">Add</button>
        </form>
        <br /><br />
        <table class="table">
            <thead>
                <tr>
                    <th>Product name</th>
                    <th>Quantity in stock</th>
                    <th>Price per item</th>
                    <th>Datetime submitted</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="product in products | orderBy:'created'">
                    <td>@{{ product.name }}</td>
                    <td>@{{ product.quantity }}</td>
                    <td>@{{ product.price }}</td>
                    <td>@{{ product.created | date:'yyyy-MM-dd HH:mm:ss' }}</td>
                    <td>@{{ product.price * product.quantity }}</td>
                </tr>
            </tbody>
            <tfooter>
                <tr colspan="5">
                    <th>Total: @{{ getTotal() }}</th>
                </tr>
            </tfooter>
        </table>
    </div>

@stop