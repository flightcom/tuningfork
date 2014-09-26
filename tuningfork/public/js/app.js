var tfApp = angular.module('tuningfork', []);

tfApp.controller('AddInstrumentCtrl', function ($scope, $http){

	$scope.instru = {};

	$scope.addcateg  = false;
	$scope.addtype  = false;
	$scope.addmarque = false;

	$scope.loadCategs();

	$scope.addCateg = function(){

		$http({
			method: 'post',
			url: '/admin/instruments/addCategorie/',
			data: 'newcateg=' + $scope.newcateg,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			console.log(data);
			$scope.results = data;
			if($scope.results.success) {
				$scope.loadCategs();
				$scope.instru.categ_id = $scope.results.categid;
			}
		}).then(function(){
			return false;
		});
	}

	$scope.loadCategs = function(){
		$http.get('/admin/instruments/getCategories/').success(function(data){
			$scope.categories = data;
		},true);

	}

	$scope.$watch('instru.categ_id', function(){
		$http.get('/admin/instruments/getTypes/'+$scope.instru.categ_id).success(function(data){
			$scope.types = data;
		});
	}, true);

	$scope.validate = function(){

		$http({
			method: 'post',
			url: '/admin/instruments/add',
			data: $.param($scope.instru),
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			$scope.result = data.result;
		}).then(function(){
			return false;
		});

	}

});

tfApp.controller('AddMembreCtrl', function ($scope, $http, $filter){

	$scope.$watch('membre.ville_code_postal', function(){
		if(!angular.isUndefined($scope.membre.ville_code_postal) && $scope.membre.ville_code_postal.length >= 3) {
			$http.get('/ajax/getcities/'+$scope.membre.ville_code_postal).success(function(data){
				$scope.villes = data.cities;
				if ( $scope.villes.length == 1) {
					$scope.membre.ville_id = $scope.villes[0].ville_id;
				}
			});			
		}
	}, true);

	$scope.$watch('membre.ville_id', function(){
		if(!angular.isUndefined($scope.membre.ville_code_postal)) {
			var found = $filter('filter')($scope.villes, {ville_id: $scope.membre.ville_id}, true);
			if(found.length) {
				$scope.membre.ville_code_postal = found[0].ville_code_postal;
			}
		}
	}, true);

});