var tfApp = angular.module('tuningfork', []);

tfApp.controller('AddInstrumentCtrl', function ($scope, $http){

	$scope.instru = {};

	$scope.changeCateg = function(categ){

		$scope.instru.type = null;
		$scope.instru.categ = categ;
		$http.get('/admin/instruments/getTypes/'+categ).success(function(data){
			console.log(data);
			$scope.types = data;
		});

	}

	$scope.addCateg = function(){
		$http.get('/admin/instruments/ajouter_categorie/')
	}

	$scope.changeType = function(index){

		console.log(index);
		$scope.instru.type = $scope.types[index];

	}


});