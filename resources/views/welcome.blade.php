@extends('layouts.default')

@section('on-page-scripts')

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script>
    var app = angular.module('ProductApp', []);

    app.controller('ProductController', function($scope, $http) {

        $scope.products = [];

        $scope.product = {
            name:'',
            quantity:'',
            price:''
        };

        $scope.init = function() {
            $http.get('/products').then(function(response) {
                $scope.products = response.data;
            });
        }

        $scope.addProduct = function() {
            $http.post('/products', $scope.product).then(function(response) {
                $scope.products = response.data;
            });
        };

        $scope.init();

    });
</script>

@stop

@section('content')

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

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="product in products">
                    <td>@{{ product.name }}</td>
                    <td>@{{ product.quantity }}</td>
                    <td>@{{ product.price }}</td>
                </tr>
            </tbody>
        </table>
    </div>

@stop