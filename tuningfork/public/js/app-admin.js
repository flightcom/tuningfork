tfApp.controller('AdminListInstruCtrl', ['$scope', '$http', '$filter', '$q', 'ngTableParams', function ($scope, $http, $filter, $q, ngTableParams){

	$scope.instruments = [];

	$scope.columns = [
		{ title: 'Identifiant', field: 'instru_id', visible: true, classes: "col-xs-1", filter: { 'instru_id': 'text' } },
		{ title: 'Catégorie', field: 'categ_pathname', visible: true, classes: "col-xs-2", filter: { 'categ_pathname': 'text' } },
		{ title: 'Marque', field: 'marque_nom', visible: true, classes: "col-xs-2", filter: { 'marque_nom': 'text' } },
		{ title: 'Modèle', field: 'instru_modele', visible: true, classes: "col-xs-2", filter: { 'instru_modele': 'text' } },
		{ title: 'Numéro de série', field: 'instru_numero_serie', visible: true, classes: "col-xs-2", filter: { 'instru_numero_serie': 'text' } },
		{ title: 'Date d\'entrée', field: 'instru_date_entree', visible: true, classes: "col-xs-2", filter: { 'instru_date_entree': 'text' } }
	];

	$scope.go = function(path){
		location.href = path;
	}

	$scope.loadInstruments = function(){

		var defer = $q.defer();
		$http.get('/admin/instruments/getInstruments/ajax').success(function(data){
			defer.resolve(data);
		},true);

		return defer.promise;

	}

	var promise = $scope.loadInstruments();

	promise.then(function(data){

		$scope.instruments = data.instruments;

		$scope.tiParams = new ngTableParams({
	        page: 1,            // show first page
	        count: 10,          // count per page
	        filter: {
	        	// instru_dispo: [0,1],
	        	// instru_etat: [0,1,2,3,4,5]
	        },
	        sorting: {
	        	instru_id: 'asc'
	        }
	    }, {
	    	filterDelay: 0,
	        total: data.length, // length of data
	        getData: function($defer, params) {
	            // use build-in angular filter
	            var orderedData = params.filter() ? $filter('filter')(data, function(value, index){
	            	var result = true;
	            	angular.forEach(value, function(valD, keyD){
	            		var paramF = params.filter()[keyD];
						if ( angular.isDefined(paramF) && paramF != '' ) {
							if ( Object.prototype.toString.call( paramF ) === '[object Array]' ) {
								if ( paramF.indexOf(valD) == -1 && paramF.indexOf(parseInt(valD)) == -1 ) { 
									result = false;
								}
							} else if (typeof(paramF) == 'string') {
								if( valD.toLowerCase().indexOf(paramF.toLowerCase()) == -1) {
									result = false;
								}
							} else if (paramF != valD){
								result = false;
							}
						}
	            	});
                    return result;
                }) : data;
	            // var orderedData = params.filter() ? $filter('filter')(data, params.filter()) : data;
				orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
	            $scope.filteredInstruments = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
	            params.total(orderedData.length); // set total for recalc pagination
	            $defer.resolve($scope.filteredInstruments);
	        }
	    });
	});

    $scope.toggleDispo = function(value){
    	var actual = $scope.tiParams.filter().instru_dispo;
    	if (value === actual) { $scope.tiParams.filter().instru_dispo = ''; }
    	var pos = -1;
    	if ( angular.isDefined(actual) && actual.length ) { 
	    	pos = actual.indexOf(value);
    	} else {
    		$scope.tiParams.filter().instru_dispo = [];
    	}

    	if (pos == -1) {
			$scope.tiParams.filter().instru_dispo.push(value);
    	} else {
			$scope.tiParams.filter().instru_dispo.splice(pos, 1);
    	}
    }

    $scope.toggleEtat = function(value){
    	var actual = $scope.tiParams.filter().instru_etat;
    	var pos = -1;
    	if ( angular.isDefined(actual) && actual.length ) { 
	    	pos = actual.indexOf(value);
    	} else {
    		$scope.tiParams.filter().instru_etat = [];
    	}

    	if (pos == -1) {
			$scope.tiParams.filter().instru_etat.push(value);
    	} else {
			$scope.tiParams.filter().instru_etat.splice(pos, 1);
    	}
    }

}]);

tfApp.controller('AdminListCategCtrl', function ($scope, $http, $filter) {

    $scope.categories = [];
    $scope.categoriesPath = [];

    $scope.loadCategories = function(parent) {

        console.log($scope.categoriesPath);

        if ( $scope.categoriesPath.length ) {
            angular.forEach($scope.categoriesPath, function(item, index){
                console.log(item);
                if ( item.parent_id == parent.parent_id ) {
                    $scope.categoriesPath.splice(index, $scope.categoriesPath.length-pos);
                    $scope.categories.splice(index, $scope.categories.length-pos);
                }
            });
        }

        var pos = $scope.categoriesPath.indexOf(parent);
        if ( pos > -1 ) {
            $scope.categoriesPath.splice(pos, $scope.categoriesPath.length-pos);
            $scope.categories.splice(pos, $scope.categories.length-pos);
        } else {
            $scope.categoriesPath.push(parent);
             $http.get('/admin/instruments/getCategories/'+(parent||null)+'/ajax').success(function(data){
                $scope.categories.push(data.categories);
                console.debug($scope.categories);
            },true);
       }

    }

        console.log($scope.categoriesPath);
    $scope.loadCategories();

});