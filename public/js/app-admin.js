tfApp.directive('activeLink', function($rootScope, $location, $route, $routeParams) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var url = $location.$$absUrl;
            var clazz = attrs.activeLink;
            var path = element.find('a').attr('href');
            if ( url.indexOf(path) > -1 ) {
                element.addClass(clazz);
            } else {
                element.removeClass(clazz);
            }
        }
    };
});

tfApp.service('ControllerChecker', ['$controller', function($controller) {
  return {
    exists: function(controllerName) {
      if(typeof window[controllerName] == 'function') {
        return true;
      }
      try {
        $controller(controllerName);
        return true;
      } catch (error) {
        return !(error instanceof TypeError);
      }
    }
  };
}]);

tfApp.factory('menu', function menuFactory() {

	var menu = {};
	var show = false;

	menu.set = function(what) {
		show = what;
	} 

	menu.visible = function() {
		return show;
	}

	return menu;

}).factory('utils', function utilsFactory(){

	var utils = {};
	utils.keys = Object.keys;
	return utils;
});

tfApp.controller('MenuCtrl', function ($scope, $localStorage, menu) {

	$scope.menu = menu;
	$scope.menu.set(false || $localStorage.showMenu);

	$scope.$watch('menu.visible()', function(){
		$localStorage.showMenu = $scope.menu.visible();
		console.log('menu = ' + $scope.menu.visible());
	});

});

tfApp.controller('AdminInstrumentsAddCtrl', function ($scope, $http, utils){

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
		categ = $scope.instru.categpath.length > 0 ? $scope.instru.categpath[0].categ_id:'';
		$http.get('/admin/instruments/getCategories/' + categ + '/ajax').success(function(data){
			$scope.categories = data.categories;
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

tfApp.controller('AdminInstrumentsListeCtrl', ['$scope', '$http', '$filter', '$q', 'ngTableParams', function ($scope, $http, $filter, $q, ngTableParams){

	$scope.init = function() {

		$http.get('admin/instruments/liste/json').success(function(data, status, headers, config) {

			$scope.instruments = data.instruments;

			$scope.tiParams = new ngTableParams({
		        page: 1,            // show first page
		        count: 10,          // count per page
		        filter: {},
		        sorting: {
		        	instru_id: 'asc'
		        }
		    }, {
		    	filterDelay: 0,
		        total: $scope.instruments.length, // length of data
		        getData: function($defer, params) {
		            // use build-in angular filter
		            var orderedData = params.filter() ? $filter('filter')($scope.instruments, function(value, index){
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

	};

	$scope.columns = [
		{ title: 'Identifiant', field: 'instru_id', visible: true, classes: "col-xs-1", filter: { 'instru_id': 'text' } },
		{ title: 'Catégorie', field: 'categ_pathname', visible: true, classes: "col-xs-2", filter: { 'categ_pathname': 'text' } },
		{ title: 'Marque', field: 'marque_nom', visible: true, classes: "col-xs-2", filter: { 'marque_nom': 'text' } },
		{ title: 'Modèle', field: 'instru_modele', visible: true, classes: "col-xs-2", filter: { 'instru_modele': 'text' } },
		{ title: 'Numéro de série', field: 'instru_numero_serie', visible: true, classes: "col-xs-2", filter: { 'instru_numero_serie': 'text' } },
		{ title: 'Date d\'entrée', field: 'instru_date_entree', visible: true, classes: "col-xs-2", filter: { 'instru_date_entree': 'text' } }
	];

	$scope.init();

	$scope.go = function(path){
		location.href = path;
	}

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

tfApp.controller('AdminInstrumentsCategoriesCtrl', function ($scope, $http, $filter) {

    $scope.categories = [];
    $scope.categoriesPath = [];
    $scope.showNewCategField = [];

    $scope.loadCategories = function(parent) {

    	var categid = parent ? parent.categ_id : '';
        $http.get('/admin/instruments/getCategories/'+categid+'/ajax').success(function(data){
        	console.log(categid);
            var niveau = null;
            angular.forEach($scope.categories, function(level, index){
                if ( level.indexOf(parent) > -1) { niveau = index; }
            });

            if ( niveau !== null && niveau <= $scope.categories.length) {
                $scope.categoriesPath.splice(niveau, $scope.categoriesPath.length-niveau-1);
                $scope.categories.splice(niveau+1, $scope.categories.length-niveau-1);
            }
            $scope.categories.push(data.categories);
        },true);

    }

    $scope.clickOnCategorie = function(parent){

    	$scope.showNewCategField = false;

        var pos = $scope.categoriesPath.indexOf(parent);
        if ( pos > -1 ) {
            $scope.categoriesPath.splice(pos, $scope.categoriesPath.length-pos);
            $scope.categories.splice(pos+1, $scope.categories.length-pos);
        } else {
	        $scope.categoriesPath.push(parent);
			$scope.loadCategories(parent);
	    }
    }

	$scope.addCateg = function(categorie, level){

        var parent = $scope.categoriesPath.length ? $scope.categoriesPath[level-1] : null;
		// console.log(categorie + ' in level ' + level + ', parent : ' + parent);
		// return;

		$http({
			method: 'post',
			url: '/admin/instruments/addCategorie/',
			data: 'newcateg=' + categorie + '&parent=' + (parent ? parent.categ_id:''),
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).success(function(data){
            // console.log(data);
			if(data.success) {
				$scope.showNewCategField = false;
                categorie = '';
                $scope.categoriesPath.splice(level, $scope.categoriesPath.length-level);
                $scope.categories.splice(level, $scope.categories.length-level);
                $scope.loadCategories(parent);
			}
		});
	}

    $scope.loadCategories();

    $scope.dropcateg = function(event) {
    	console.log('test');
    }

});

tfApp.controller('AdminMembresListeCtrl', function ($scope, $http, $filter, $q, ngTableParams) {

	$scope.$watch('membres', function(value) {

		$http.get('admin/membres/liste/json').success(function(data, status, headers, config) {

			$scope.membres = data.membres;

			$scope.tmParams = new ngTableParams({
		        page: 1,            // show first page
		        count: 10,          // count per page
		        filter: {},
		        sorting: {
		        	membre_id: 'asc'
		        }
		    }, {
		    	filterDelay: 0,
		        total: $scope.membres.length, // length of data
		        getData: function($defer, params) {
		            // use build-in angular filter
		            var orderedData = params.filter() ? $filter('filter')($scope.membres, params.filter()) : $scope.membres;
					orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
		            $scope.filteredMembres = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
		            params.total(orderedData.length); // set total for recalc pagination
		            $defer.resolve($scope.filteredMembres);
		        }
		    });

	    });

	});

	$scope.columns = [
		{ title: 'Identifiant', field: 'membre_id', visible: true, classes: "col-xs-1", filter: { 'membre_id': 'text' } },
		{ title: 'Nom', field: 'membre_nom', visible: true, classes: "col-xs-2", filter: { 'membre_nom': 'text' } },
		{ title: 'Prénom', field: 'membre_prenom', visible: true, classes: "col-xs-2", filter: { 'membre_prenom': 'text' } },
		{ title: 'Téléphone', field: 'membre_tel', visible: true, classes: "col-xs-2", filter: { 'membre_tel': 'text' } },
		{ title: 'Email', field: 'membre_email', visible: true, classes: "col-xs-2", filter: { 'membre_email': 'text' } },
		{ title: 'Adresse', field: 'adr_voie', visible: true, classes: "col-xs-2", filter: { 'adr_voie': 'text' } },
		{ title: 'Ville', field: 'ville_nom', visible: true, classes: "col-xs-2", filter: { 'ville_nom': 'text' } }
	];

	$scope.go = function(path){
		location.href = path;
	}

});

tfApp.controller('AdminMembresAddCtrl', function ($scope, $http, $filter){

	$scope.membre = {};

	$scope.$watch('membre.ville_code_postal', function(){
		console.log('watch');
		if($scope.membre && $scope.membre.ville_code_postal && $scope.membre.ville_code_postal.length == 5 ) {
			console.log('ok');
			$http.get('/ajax/getcities/'+$scope.membre.ville_code_postal).success(function(data){
				console.log(data);
				$scope.villes = data.cities;
				if ( $scope.villes.length == 1) {
					$scope.membre.ville_id = $scope.villes[0].ville_id;
				}
			});			
		} else {
			$scope.membre.ville_id = null;
		}
	}, true);

	// $scope.$watch('membre.ville_id', function(){
	// 	if($scope.membre && $scope.membre.ville_code_postal) {
	// 		var found = $filter('filter')($scope.villes, {ville_id: $scope.membre.ville_id}, true);
	// 		console.log(found)
	// 		if(angular.isDefined(found)) {
	// 			$scope.membre.ville_code_postal = found[0].ville_code_postal;
	// 		}
	// 	}
	// }, true);

});


tfApp.controller('AdminMembresEditCtrl', function ($scope, $http, $filter){

	$scope.$watch('membre.ville_code_postal', function(){
		if($scope.membre && $scope.membre.ville_code_postal ) {
			console.log('ok');
			$http.get('/ajax/getcities/'+$scope.membre.ville_code_postal).success(function(data){
				console.log(data);
				$scope.villes = data.cities;
				if ( $scope.villes.length == 1) {
					$scope.membre.ville_id = $scope.villes[0].ville_id;
				}
			});			
		}
	}, true);

	$scope.$watch('membre.ville_id', function(){
		if($scope.membre && $scope.membre.ville_code_postal) {
			var found = $filter('filter')($scope.villes, {ville_id: $scope.membre.ville_id}, true);
			console.log(found)
			if(angular.isDefined(found)) {
				$scope.membre.ville_code_postal = found[0].ville_code_postal;
			}
		}
	}, true);

});

tfApp.controller('AdminListArticlesCtrl', function ($scope, $http, $filter, $q, ngTableParams) {

	$scope.articles = [];

	$scope.columns = [
		{ title: 'Titre', field: 'article_titre', visible: true, classes: "col-xs-2", filter: { 'article_titre': 'text' } },
		{ title: 'Auteur', field: 'membre_nom_complet', visible: true, classes: "col-xs-2", filter: { 'membre_nom': 'text' } },
		{ title: 'Date d\'ajout', field: 'article_date_creation', visible: true, classes: "col-xs-2", filter: { 'article_date_creation': 'text' } },
		{ title: 'Dernière mise à jour', field: 'article_date_last_update', visible: true, classes: "col-xs-2", filter: { 'article_date_last_update': 'text' } }
	];

	$scope.go = function(path){
		location.href = path;
	}

	$scope.loadArticles = function(){

		var defer = $q.defer();
		$http.get('/admin/blog/get_articles/ajax').success(function(data){
			defer.resolve(data);
		},true);

		return defer.promise;

	}

	var promise = $scope.loadArticles();

	promise.then(function(data){

		$scope.articles = data.articles;

		$scope.tbParams = new ngTableParams({
	        page: 1,            // show first page
	        count: 10,          // count per page
	        filter: {
	        	// instru_dispo: [0,1],
	        	// instru_etat: [0,1,2,3,4,5]*
	        },
	        sorting: {
	        	article_date_last_update: 'desc'
	        }
	    }, {
	    	filterDelay: 0,
	        total: $scope.articles.length, // length of data
	        getData: function($defer, params) {
	            // use build-in angular filter
	            var orderedData = params.filter() ? $filter('filter')($scope.articles, params.filter()) : $scope.articles;
				orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;
	            $scope.filteredArticles = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
	            params.total(orderedData.length); // set total for recalc pagination
	            $defer.resolve($scope.filteredArticles);
	        }
	    });
	});

});

tfApp.controller('AdminEditArticleCtrl', function ($scope, $http){

	$scope.editorEnabled = false;

	$scope.$watch('article', function(oldvalues, newvalues){
		$scope.update();
	}, true);

	$scope.$watch('isEditingContent', function(){
		if ( $scope.isEditingContent == false ) {
			console.log($scope.article_contenu_temp);
			$scope.article.article_contenu = $scope.article_contenu_temp;
		}
	})

    $scope.update = function(){

        $http.post('update/ajax', 
        	{ article: $scope.article }
        ).success(function(data){
        	console.log('ok');
        	$scope.article = data.article;
        });

    }

});

tfApp.controller('AdminListPretsCtrl', ['$scope', '$http', '$filter', '$q', 'ngTableParams', function ($scope, $http, $filter, $q, ngTableParams){

	$scope.prets = [];

	$scope.columns = [
		{ title: 'Nom', field: 'membre_nom', visible: true, classes: "col-xs-1", filter: { 'membre_nom': 'text' } },
		{ title: 'Prénom', field: 'membre_prenom', visible: true, classes: "col-xs-1", filter: { 'membre_prenom': 'text' } },
		{ title: 'Téléphone', field: 'membre_tel', visible: true, classes: "col-xs-1", filter: { 'membre_tel': 'text' } },
		{ title: 'Email', field: 'membre_email', visible: true, classes: "col-xs-2", filter: { 'membre_email': 'text' } },
		// { title: 'Catégorie', field: 'categ_path_name', visible: true, classes: "col-xs-2", filter: { 'categ_path_name': 'text' } },
		// { title: 'Marque', field: 'marque_nom', visible: true, classes: "col-xs-1", filter: { 'marque_nom': 'text' } },
		// { title: 'Modèle', field: 'instru_modele', visible: true, classes: "col-xs-1", filter: { 'instru_modele': 'text' } },
		{ title: 'Date d\'emprunt', field: 'emp_date_debut', visible: true, classes: "col-xs-1", filter: { 'emp_date_debut': 'text' } },
		{ title: 'Date de remise prévue', field: 'emp_date_fin_prevue', visible: true, classes: "col-xs-1", filter: { 'emp_date_fin_prevue': 'text' } },
		{ title: 'Date de remise effective', field: 'emp_date_fin_effective', visible: true, classes: "col-xs-1", filter: { 'emp_date_fin_effective': 'text' } }
	];

	$scope.go = function(path){
		location.href = path;
	}

	$scope.loadPrets = function(){

		var defer = $q.defer();
		$http.get('/admin/prets/getList/ajax').success(function(data){
			defer.resolve(data.emprunts);
		},true);

		return defer.promise;

	}

	var promise = $scope.loadPrets();

	promise.then(function(data){

		$scope.prets = data;

		$scope.tpParams = new ngTableParams({
	        page: 1,            // show first page
	        count: 10,          // count per page
	        filter: {
	        	// instru_dispo: [0,1],
	        	// instru_etat: [0,1,2,3,4,5]
	        },
	        sorting: {
	        	emp_id: 'asc'
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
	            $scope.filteredPrets = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
	            params.total(orderedData.length); // set total for recalc pagination
	            $defer.resolve($scope.filteredPrets);
	        }
	    });
	});

    $scope.toggleClosed = function(value){
    	var actual = $scope.tpParams.filter().emprunt_is_closed;
    	var pos = -1;
    	if ( angular.isDefined(actual) && actual.length ) { 
	    	pos = actual.indexOf(value);
    	} else {
    		$scope.tpParams.filter().emprunt_is_closed = [];
    	}

    	if (pos == -1) {
			$scope.tpParams.filter().emprunt_is_closed.push(value);
    	} else {
			$scope.tpParams.filter().emprunt_is_closed.splice(pos, 1);
    	}
    }

    $scope.toggleRetard = function(){
    	$scope.tpParams.filter().emprunt_is_delayed = !$scope.tpParams.filter().emprunt_is_delayed;
    }

}]);