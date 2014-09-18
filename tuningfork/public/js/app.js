var tfApp = angular.module('tuningfork', []);

tfApp.controller('AddInstrumentCtrl', function ($scope, $http){

	// $scope.instru = {
	// 	type_id: '',
	// 	categ_id: '',
	// 	marque_id: '',
	// 	instru_modele: '',
	// 	instru_numero: '',
	// 	instru_etat: 0,
	// 	instru_dispo: '',
	// 	instru_a_verifier: 0
	// };

	$scope.addcateg  = false;
	$scope.addtype  = false;
	$scope.addmarque = false;

	$scope.changeCateg = function(){

		$scope.instru.type_id = '';
		$http.get('/admin/instruments/getTypes/'+$scope.instru.categ_id).success(function(data){
			$scope.types = data;
		});

	}

	$scope.addCateg = function(){
		$http.post('/admin/instruments/ajouter_categorie/')
	}

	$scope.changeType = function(index){

		$scope.instru.type = $scope.types[index];
	}

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

	$scope.submit = function(){

		console.log('submit');

		$http({
			method: 'post',
			url: '/admin/instruments/add',
			data: $.param($scope.instru),
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			// console.log(data.result);
			$scope.result = data.result;
		});
	}


});