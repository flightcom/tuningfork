tfApp.controller('AdminListInstruCtrl', ['$scope', 'utilities', '$http', '$filter', '$q', 'ngTableParams', function ($scope, utilities, $http, $filter, $q, ngTableParams){

	// $scope.instruments = <?php print_r($instruments); ?>;
	// $scope.instruments = [];

	// console.log($scope.instruments);

	$scope.showcol = {
		dateEntree: false,
		aVerifier: false,
		numeroSerie: false
	};

	$scope.showTable = false;

	var defer = $q.defer();

	// $http.get('/admin/instruments/liste/json/').success(function(data){
	// 	$scope.instruments = data.instruments;
	// 	$scope.showTable = true;
	// 	defer.resolve();
	// },true);

	$scope.loadInstruments = function(){

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
				categ_id: '',
				categ_nom: ''
	        },
	        sorting: {
	        	instru_id: 'asc'
	        }
	    }, {
	    	filterDelay: 0,
	        total: data.length, // length of data
	        getData: function($defer, params) {
	            // use build-in angular filter
	            var orderedData = params.filter() ? $filter('filter')(data, params.filter()) : data;
				orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
	            $scope.filteredInstruments = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
	            params.total(orderedData.length); // set total for recalc pagination
	            $defer.resolve($scope.filteredInstruments);
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

    $scope.getMarques = function() {
        var def = $q.defer(),
            arr = [],
            names = [];
        angular.forEach($scope.filteredInstruments, function(item){
        	console.log(item);
            if (inArray(item.marque_nom, arr) === -1) {
                arr.push(item.marque_nom);
                names.push({
                    'id': item.marque_nom,
                    'title': item.marque_nom
                });
            }
        });
        def.resolve(names);
        return def;
    };

    // $scope.$watch('filteredInstruments', function(){
    // 	$scope.selectmarque = $scope.getMarques();
    // });

}]);
