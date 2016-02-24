// Ionic Starter App

// angular.moduleme of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('lushApp', ['ionic'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})
.directive('hideTabs', function($rootScope) {
      return {
          restrict: 'A',
          link: function($scope, $el) {
              $rootScope.hideTabs = 'tabs-item-hide';
              $scope.$on('$destroy', function() {
                  $rootScope.hideTabs = '';
              });
          }
      };
    }
);

.config(function($stateProvider, $urlRouterProvider){
    $stateProvider
        .state('signUp', {
        url:'/signUp',
        templateUrl: "templates/signUp.html"
        
    })
    
})
