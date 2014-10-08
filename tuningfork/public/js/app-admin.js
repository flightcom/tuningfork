tfApp.controller('AdminListInstruCtrl', function ($scope, $http, $filter, $q, ngTableParams){

	$scope.instruments = [];

	$scope.showcol = {
		dateEntree: false,
		aVerifier: false,
		numeroSerie: false
	};

	$scope.showTable = false;

	$scope.loadInstruments = function(){

		$http.get('/admin/instruments/liste/json/').success(function(data){
			$scope.instruments = data.instruments;
			$scope.showTable = true;
		},true);

	}

	$scope.loadInstruments();

	$scope.tableInstruments = new ngTableParams({
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
        total: $scope.instruments.length, // length of data
        getData: function($defer, params) {
            // use build-in angular filter
            var orderedData = params.filter() ? $filter('filter')($scope.instruments, params.filter()) : $scope.instruments;
			orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
            $scope.filteredInstruments = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
            params.total(orderedData.length); // set total for recalc pagination
            $defer.resolve($scope.filteredInstruments);
        }
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

});