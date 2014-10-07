tfApp.controller('AdminListInstruCtrl', function ($scope, $http, $filter, ngTableParams){

	$scope.instruments = [];

	$scope.hidecol = {
		col_dateEntree: false,
		col_aVerifier: false,
		col_numeroSerie: false
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
        }
    }, {
        // total: data.length, // length of data
        // getData: function($defer, params) {
        //     // use build-in angular filter
        //     var orderedData = params.filter() ? $filter('filter')(data, params.filter()) : data;
        //     $scope.users = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
        //     params.total(orderedData.length); // set total for recalc pagination
        //     $defer.resolve($scope.users);
        // }
    });

});