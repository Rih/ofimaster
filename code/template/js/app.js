var app = angular.module("app",[]);
this.data = '';
var products = [
			{
				id: 1,
				name:'Quix',
				mark:'Quix S.A.'
			},
			{
				id: 2,
				name:'Ariel',
				mark:'Matic S.A.'
			},
		];

app.controller("SetProductController", function($scope){	
	
	$scope.products = products;

    $scope.addItem = function (index) {
        products.push({
            id: $scope.products.length + 1,
            name: $scope.productname,
            mark: $scope.productmark
        });
        $scope.input = '';
        console.log(products);
    }
     $scope.deleteItem = function (index) {
        products.splice(index, 1);
        console.log(products);
    }

});