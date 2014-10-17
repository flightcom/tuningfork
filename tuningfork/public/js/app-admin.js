tfApp.controller('AdminAddInstrumentCtrl', ['$scope', 'utilities', function ($scope, $http){

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
		$http.get('/admin/instruments/getCategories/' + categ + '/ajax').success(function(data){
			// console.log(data);
			$scope.categories = data;
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

}]);

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

    $scope.showNewCategField = false;

    $scope.loadCategories = function(parent) {

    	var categid = parent ? parent.categ_id : null;
        $http.get('/admin/instruments/getCategories/'+categid+'/ajax').success(function(data){
            $scope.categories.push(data.categories);        		
        },true);

    }

    $scope.clickOnCategorie = function(parent){

    	$scope.showNewCategField = false;

        var pos = $scope.categoriesPath.indexOf(parent);
        var niveau;
        angular.forEach($scope.categories, function(level, index){
        	if ( level.indexOf(parent) > -1) {
        		niveau = index;
        	}
        });

        if ( niveau !== undefined && niveau <= $scope.categories.length) {
            $scope.categoriesPath.splice(niveau, $scope.categoriesPath.length-niveau);
            $scope.categories.splice(niveau+1, $scope.categories.length-niveau);
        }

        if ( pos > -1 ) {
            $scope.categoriesPath.splice(pos, $scope.categoriesPath.length-pos);
            $scope.categories.splice(pos+1, $scope.categories.length-pos);
        } else {
	        $scope.categoriesPath.push(parent);
			$scope.loadCategories(parent);
	    }
    }

	$scope.addCateg = function(level){

		console.log($scope.newcateg);
		return;

		$http({
			method: 'post',
			url: '/admin/instruments/addCategorie/',
			data: 'newcateg=' + $scope.newcateg + '&parent=' + $scope.categoriesPath[level-1].categ_id,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
			$scope.results = data;
			if($scope.results.success) {
				$scope.showNewCategField = false;
				$scope.newcateg = '';
			}
		});
	}

    // $scope.addCateg = function(newcateg, level) {
    // 	console.log(newcateg + ' in level '+level+' with parent ' + $scope.categoriesPath[level-1].categ_id);
    // }

    $scope.loadCategories();

});