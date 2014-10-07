tfApp.controller('AdminListInstruCtrl', function ($scope, $http, $filter, $q, ngTableParams){

	$scope.instruments = [];

	$scope.hidecol = {
		dateEntree: true,
		aVerifier: true,
		numeroSerie: true
	};

	$scope.loadInstruments = function(){

		$http.get('/admin/instruments/liste/json/').success(function(data){
			$scope.instruments = data.instruments;
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
            }
    $scope.selectlist = function(column) {
        var def = $q.defer(),
            arr = [],
            selectlist = [];
        angular.forEach($scope.filteredInstruments, function(item){
            if (inArray(item.marque_nom, arr) === -1) {
                arr.push(item.marque_nom);
                selectlist.push({
                    'id': item.marque_id,
                    'title': item.marque_nom
                });
            }
        });
        def.resolve(selectlist);
        return def;
    };

});