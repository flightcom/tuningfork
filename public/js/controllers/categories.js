(function () {
    // @ngInject
    function CategoriesCtrl($scope, $http, $filter){
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
    }

    angular
        .module('app')
        .controller('CategoriesCtrl', CategoriesCtrl);

})();










