var tfApp = angular.module('tuningfork', []);

tfApp.controller('AddInstrumentCtrl', function ($scope, $http){

	$scope.instru = {};

	$scope.addcateg  = false;
	$scope.addtype  = false;
	$scope.addmarque = false;

	$scope.addCateg = function(){
		$http.post('/admin/instruments/ajouter_categorie/')
	}

	$scope.$watch('instru.categ_id', function(){
		// console.log(instru.categ_id);
		// if(instru.categ_id) {
			$http.get('/admin/instruments/getTypes/'+$scope.instru.categ_id).success(function(data){
				$scope.types = data;
			});
		// }
	}, true);

	$scope.validate = function(){

		console.log('validate');

		$http({
			method: 'post',
			url: '/admin/instruments/add',
			data: $.param($scope.instru),
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			console.log(data.result);
			$scope.result = data.result;
		}).then(function(){
			return false;
		});

	}

});