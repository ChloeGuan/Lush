var userInfo = {};

var lushUser = angular.module("lushAppUser",[]);

lushApp.controller("user", ["$scope","$location",
    function($scope,$location){
    //SIGN UP
       $scope.signUp = function(u,p,cp,e,dn){
           //console.log(this,u,p,cp,e,dn)
           if(p == cp){
           jQuery.ajax({
               url: "../lushAppServer/controller/userControl.php",
               dataType: "json",
               type: "POST",
               data: {
                   signUp: true,
                   username: u,
                   password: cp,
                   email: e,
                   displayname: dn
               },
               success: function(res){
                   console.log(res);
               }
           });
       }
       else{
           alert("Passwords must be the same!")
       }
    };
    //END SIGN UP
    
    //LOG IN
    $scope.logIn = function(u,p){
        jQuery.ajax({
            url: "../lushAppServer/controller/userControl.php",
               dataType: "json",
               type: "POST",
               data: {
                   logIn: true,
                   username: u,
                   password: p
               },
               success: function(res){
                   console.log(res);
                   
                   if(res[0].username && res[0].type == "user"){
                       $scope.userInfo = res;
                       $scope.login = true;
                       console.log("user",$scope);
                       $scope.$apply(function(){
                       //$location.path("/user");
                       });
                       
                }else{
                    alert(res);
                }
            }
        });
    }
    //END LOG IN
}])
.controller("userInfo",["$scope",function($scope){
    //$scope.login = true;
    $scope.say = function(){
        alert("hi");
        
        
    }
}
    
]);