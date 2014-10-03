var tfApp = angular.module('tuningfork', [])
.directive('ngFocusOn', function($timeout) {
    return {
        link: function(scope, element, attrs) {
            scope.$watch(attrs.ngFocusOn, function(newValue){
                newValue && $timeout(function(){element.focus()}, 10);
            });
        }
	};    
}).filter('reverse', function() {
  return function(items) {
    return items.slice().reverse();
  };
});

tfApp.controller('AddInstrumentCtrl', function ($scope, $http){

	$scope.instru = {
		categpath: []
	};

	$scope.addcateg  = false;
	$scope.addtype  = false;
	$scope.addmarque = false;

	$scope.addCateg = function(){

		$http({
			method: 'post',
			url: '/admin/instruments/addCategorie/',
			data: 'newcateg=' + $scope.newcateg + '&parent=' + $scope.instru.categpath[0].categ_id,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			$scope.results = data;
			if($scope.results.success) {
				$scope.loadCategs();
				$scope.addcateg = false;
				$scope.newcateg = '';
				$scope.instru.categ_id = $scope.results.categid.toString();
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
				$scope.newmarque = '';
				$scope.instru.marque_id = $scope.results.marqueid.toString();
			}
		}).then(function(){
			return false;
		});

	}

	$scope.loadCategs = function(){
		// categ = $scope.instru.categpath.slice(-1)[0].categ_id;
		categ = $scope.instru.categpath.length > 0 ? $scope.instru.categpath[0].categ_id:'';
		// console.log(categ);
		$http.get('/admin/instruments/getCategories/' + categ ).success(function(data){
			// console.log(data);
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

	$scope.removeLeafCateg = function(){
		$scope.instru.categpath.shift();
		$scope.categorie = $scope.instru.categpath[0];
	}

	$scope.removeCateg = function(categ){
		var index = $scope.instru.categpath.indexOf(categ);
		$scope.instru.categpath.splice(0, index+1);
		$scope.categorie = $scope.instru.categpath[0];
	}

	$scope.loadCategs();
	$scope.loadMarques();

	$scope.$watch('categorie', function(){
		if ( $scope.categorie !== undefined && $scope.instru.categpath.indexOf($scope.categorie) == -1 ) {
			$scope.instru.categpath.unshift($scope.categorie);
		}
		$scope.loadCategs();
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

tfApp.controller('CategoriesCtrl', function ($scope, $http, $filter){

	$scope.$watch('parent.categ_id', function(){
		if ( !angular.isUndefined($scope.parent.categ_id) ) {
			$http.get('/instruments/getCategorieInfos/'+$scope.parent.categ_id).success(function(data){
				$scope.parent = data.categorie;
				$scope.path = $scope.parent.path.split(',');
			});
		}

		console.log($scope.parent);
		$http.get('/instruments/getChildrenCategories/'+$scope.parent.categ_id||'').success(function(data){
			$scope.children = data;
			console.log($scope.children);
		});
	}, true);

});