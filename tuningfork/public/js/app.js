var tfApp = angular.module('tuningfork', [])
	.directive('ngFocusOn', function() {
	    return {
	        link: function(scope, element, attrs) {
	            scope.$watch(attrs.ngFocusOn, function(newValue){
	                if ( newValue ) {
	                    element.focus();
	                }
	            });
	        }
		};    
	});


tfApp.controller('AddInstrumentCtrl', function ($scope, $http){

	$scope.instru = {
		categ_id: null
	};

	$scope.addcateg  = false;
	$scope.addtype  = false;
	$scope.addmarque = false;

	$scope.addCateg = function(){

		$http({
			method: 'post',
			url: '/admin/instruments/addCategorie/',
			data: 'newcateg=' + $scope.newcateg,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			$scope.results = data;
			if($scope.results.success) {
				$scope.loadCategs();
				$scope.addcateg = false;
				$scope.instru.categ_id = $scope.results.categid.toString();
			}
		}).then(function(){
			return false;
		});
	}

	$scope.addType = function(){

		$http({
			method: 'post',
			url: '/admin/instruments/addType/',
			data: 'newtype=' + $scope.newtype + '&categorie='+$scope.instru.categ_id,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			$scope.results = data;
			if($scope.results.success) {
				$scope.loadTypes();
				$scope.addtype = false;
				$scope.instru.type_id = $scope.results.typeid.toString();
			}
		}).then(function(){
			return false;
		});

	}

	$scope.addMarque = function(){

		$http({
			method: 'post',
			url: '/admin/instruments/addMarque/',
			data: 'newmarque=' + $scope.newmarque ,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			$scope.results = data;
			if($scope.results.success) {
				$scope.loadMarques();
				$scope.addmarque = false;
				$scope.instru.marque_id = $scope.results.marqueid.toString();
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

	$scope.loadTypes = function(){
		$http.get('/admin/instruments/getTypes/' + $scope.instru.categ_id).success(function(data){
			$scope.types = data;
		},true);

	}

	$scope.loadMarques = function(){
		$http.get('/admin/instruments/getMarques/').success(function(data){
			$scope.marques = data;
		},true);

	}

	$scope.loadCategs();
	$scope.loadMarques();

	$scope.$watch('instru.categ_id', function(){
		$scope.loadTypes();
	}, true);

	$scope.$watch('addmarque', function(){
		if($scope.addmarque) {
			newinstrument.newmarque.focus();
		}
	});

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

