// var tfApp = angular.module('app', ['ngTable', 'ngSanitize', 'ngRoute'])
var tfApp = angular.module('app')
.directive('ngFocusOn', function($timeout) {
	return {
		link: function(scope, element, attrs) {
			scope.$watch(attrs.ngFocusOn, function(newValue){
				newValue && $timeout(function(){element.focus()}, 10);
			});
		}
	};    
}).directive('squarebox', function ($window) {
	return {
		restrict: "C",
		link: function (scope, element) {
			scope.getWidth = function () {
				return $(element).width();
			};
			scope.$watch(scope.getWidth, function (width) {
				$(element).height(width);
			});
			return angular.element($window).bind('resize', function() {
				scope.getWidth();
				return scope.$apply();
			});
		}
   }
}).directive('ngClassTh', function() {
	return {
		restrict: "A",
		link: function (scope, element, attrs) {
			scope.$watch(attrs.ngClassTh , function (classes) {
				var index = $(element).closest('tr').children('td').index($(element));
				// console.log(classes.join(' '));
				$(element).closest('table').find('thead > tr').each(function(){
					$(this).children('th').eq(index).addClass(classes.join(' '));
				});
			});
		}
   }
}).directive('ngEnter', function () {
	return function (scope, element, attrs) {
		element.bind("keydown keypress", function (event) {
			if(event.which === 13) {
				scope.$apply(function (){
					// console.log(attrs.ngEnter);
					scope.$eval(attrs.ngEnter);
				});

				event.preventDefault();
			}
		});
	};
}).directive('ngEscape', function () {
	return function (scope, element, attrs) {
		element.bind("keydown keypress", function (event) {
			if(event.which === 27) {
				scope.$apply(function (){
					// console.log(attrs.ngEnter);
					scope.$eval(attrs.ngEscape);
				});

				event.preventDefault();
			}
		});
	};
}).directive('ngColspan', function () {
	return {
		restrict: "A",
		link: function (scope, element, attrs) {
			scope.$watch(attrs.ngColspan , function (col) {
				console.log(col);
				$(element).attr('colspan', col);
			});
		}
   }
}).filter('reverse', function() {
	return function(items) {
		return items.slice().reverse();
	};
}).filter('split', function() {
	return function(input, delimiter) {
		var delimiter = delimiter || ',';
		return input.split(delimiter);
	} 
}).filter('isEmpty', function () {
	var bar;
	return function (obj) {
		if ( Object.prototype.toString.call( obj ) === '[object Array]' ) {
			if ( obj !== undefined && obj.length !== 0 && obj !== null ) {
				return false;
			}
		} else if (typeof(obj) == 'object') {
			for (bar in obj) {
				if (obj.hasOwnProperty(bar)) {
					return false;
				}
			}           
		} else if ( typeof(obj) == 'string') {
			if ( obj !== undefined && obj.length !== 0 && obj !== null ) {
				return false;
			}
		}
		return true;
	};
});

tfApp.factory('utilities', function() {
	return {
		go: function(path) {
			console.log('go');
			$location.path(path);
		}
	};
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
			console.log(found)
			if(angular.isDefined(found)) {
				$scope.membre.ville_code_postal = found[0].ville_code_postal;
			}
		}
	}, true);

});

tfApp.controller('MainMenuCtrl', function ($scope, $http){

	// $scope.

});
