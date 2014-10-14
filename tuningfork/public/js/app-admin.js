// tfApp.controller('AdminListInstruCtrl', ['$scope', 'utilities', '$http', '$filter', '$q', 'ngTableParams', function ($scope, utilities, $http, $filter, $q, ngTableParams){
tfApp.controller('AdminListInstruCtrl', ['$scope', 'utilities', '$http', '$filter', '$q', 'ngTableParams', function ($scope, utilities, $http, $filter, $q, ngTableParams){

	$scope.instruments = [];

	$scope.columns = [
		{ title: 'Identifiant', field: 'instru_id', visible: true, classes: "col-xs-1", filter: { 'instru': 'text' } },
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

		$scope.tableInstrumentsParams = new ngTableParams({
	        page: 1,            // show first page
	        count: 10,          // count per page
	        filter: {
	        	instru_etat: []
	        },
	        sorting: {instru_id: 'asc'}
	    }, {
	    	filterDelay: 0,
	        total: data.length, // length of data
	        getData: function($defer, params) {
	            // use build-in angular filter
	            // console.log(data);
	            var orderedData = params.filter() ? $filter('filter')(data, function(value, index){
	            	angular.forEach(value, function(valD, keyD){
						angular.forEach(params.filter(), function(valF, keyF){
							// console.log(Object.prototype.toString.call( valF ));
							if ( keyF == keyD ) {
								if ( Object.prototype.toString.call( valF ) === '[object Array]' ) {
                                    console.log(valF.toString() + ', ' + valD);
									return inArray(valD, valF) > -1;
								} else {
									return valF == valD;
								}
							}
						});
	            	});
                    return false;
                }) : data;
	            // var orderedData = params.filter() ? $filter('filter')(data, params.filter()) : data;
				orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
	            $scope.filteredInstruments = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
	            params.total(orderedData.length); // set total for recalc pagination
	            $defer.resolve($scope.filteredInstruments);
	            // $scope.apply();
	            return $defer.promise;
	        }
	    });
	});

    var inArray = Array.prototype.indexOf ?
        function (val, arr) {
            return arr.indexOf(val)
        } :
        function (val, arr) {
            var i = arr.length;
            while (i--) {
                if (arr[i] === val) return i;
            }
            return -1;
        };

    $scope.selectlist = function(column) {
        var def = $q.defer(),
            arr = [],
            selectlist = [];
        angular.forEach($scope.filteredInstruments, function(item){
        	console.log(item);
            if (inArray(item.marque_nom, arr) === -1) {
                arr.push(item.marque_nom);
                selectlist.push({
                    'id': item.marque_nom,
                    'title': item.marque_nom
                });
            }
        });
        def.resolve(selectlist);
        return def.promise;
    };

    $scope.toggleDispo = function(value){
    	var actual = $scope.tableInstrumentsParams.filter().instru_dispo;
    	if (value === actual) { $scope.tableInstrumentsParams.filter().instru_dispo = ''; }
    	else { $scope.tableInstrumentsParams.filter().instru_dispo = value; }
    }

    $scope.toggleEtat = function(value){
    	var actual = $scope.tableInstrumentsParams.filter().instru_etat;
    	// if (value === actual) { $scope.tableInstrumentsParams.filter().instru_etat = ''; }
    	// else { $scope.tableInstrumentsParams.filter().instru_etat = value; }
    	var pos = inArray(value, actual);
    	if (pos == -1) { $scope.tableInstrumentsParams.filter().instru_etat.push(value); }
    	else { $scope.tableInstrumentsParams.filter().instru_etat.splice(pos, 1); }
    	console.log($scope.tableInstrumentsParams.filter().instru_etat);
    }

    // var promise2 = $scope.selectlist();

    // promise2.then(function(data){
    // 	$scope.selectlist = data;
    // });

    // $scope.$watch('filteredInstruments', function(){
    // 	$scope.selectmarque = $scope.getMarques();
    // });

}]);