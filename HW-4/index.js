
var app = angular.module('test',[]);

    app.controller('test', function($scope, $http) 
    {
        
        $scope.name="";
        $scope.pic="";
        window.fbAsyncInit = function(name) {
    FB.init({
      appId      : '133216680547582',
      status: true,
      cookie: true,
      xfbml      : true,
      version    : 'v2.4'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
        
        $scope.postfunc=function(name,pic)
           {
           
                FB.ui({
      app_id: '133216680547582',
      method:'feed',
      display:'popup',
      link: window.location.href,
      picture: pic,
      name: name,
      caption: "FB SEARCH FROM USC CSCI571",
      }, function(response){
      if (response && !response.error_message)
        alert("Posted Successfully");
      else 
        alert("Not Posted");
      });

               
           }
        
        
        
        $scope.type_name="user";

       $scope.previous="";
        $scope.next="";
        $scope.favData={};
        
        $scope.func1=function(search,type)
        {
            $scope.firstpage=true;
            $scope.secondpage=false;
            $scope.favoritespage=false;
            $scope.Next=true;
            $scope.url="index.php";
            $scope.type_name=type;
            //alert(1)
            //alert(search);
           // alert(type);
            //alert($scope.url);
             $scope.prog=true;
            $http({
                method: "GET",
                url: $scope.url,
                params:{search:search,type:type},
               
                
            }).success(function (response) 
            {
                 
             /*   //var splitnext=ne.strip(":");
                //alert(1)
                //split1=splitnext[1];
                //alert(2)
                //$scope.next=split1;
                //alert(3)
                //alert("hello");
                //alert(response)
                //alert("paging");
               //$scope.next=response["next"];
                
                /*$scope.mySplit = function(string, $scope.next) {
                var array = string.split(':');
                return array[nb];
                    }*/
                //alert($scope.next);
                //$scope.next=$scope.paging["next"];
                //alert("after paging");
                //alert($scope.next);
                //alert("after next");
                //alert(response["previous"]);
                //alert("after previous");*/
                //console.log(response);
                angular.forEach(response,function(value,key)
                {
                                //alert(localStorage.getItem(value.id));
                                if(localStorage.getItem(value.id) ===null)
                {
                    response[key]["mark"]=0;
                }
                else{
                    response[key]["mark"]=1;
                    //alert(1);
                }
                                });
                       //console.log(response);
                $scope.prog=false;
                 $scope.myData=response;
                var ne=response["next"];
                $scope.next=ne;
            });
        }
        
        $scope.func2=function(id,name,pic,type)
        {
            $scope.secondpage=true;
            $scope.firstpage=false;
            $scope.favoritespage=false;
           $scope.url="index.php";
            
            
//            alert(2);
//            alert(id);
//            alert(type);
//            alert(name);
            $scope.name=name;
            $scope.pic=pic;
            //alert(pic);
            $http({
                method: "GET",
                url: $scope.url,
                params:{id:id,type:type},
  
            }).success(function(response2) 
            {
                
                $scope.details=response2["albums"];
                $scope.posts=response2["posts"];
               /* //alert("inside5")
                //alert(response2)
                //console.log("hellooooooooo")
                //console.log(response2["posts"])
                //$scope.mydata22 = response2;
                //console.log(mydata22);
                
                //alert($scope.details);
                
                //alert("hello world");
                //alert(response2)
                //console.log(response2);*/
                
            });
        }
        
         $scope.func3clear=function(){
      	 //alert(3)
            $scope.secondpage=false;
            $scope.firstpage=false;
            $scope.search="";
          }
         
         
         $scope.funcnext=function()
        {
             $scope.Prev=true;
             $scope.firstpage=true;
             //$queryStr=explode(":",$scope.next)
             $scope.check=$scope.next;
             
             
                //$queryStr = explode("search", $nextUrl);
                //$query= "/search".$queryStr[1];
             
               $http({
                method: "GET",
                url: $scope.check,
                
  
            }).success(function(response3) 
            {
                $scope.myData=response3;
              /*  //$scope.next=response3["paging"]["next"];
                //alert("inside5")
                //alert(response2)
                //console.log("hellooooooooo")
                //console.log(response2["posts"])
                //$scope.mydata22 = response2;
                //console.log(mydata22);
                
                //alert($scope.details);
                
                //alert("hello world");
                //alert(response2)
                //console.log(response2);
                */
            });
          
        }
         
           $scope.favfunc=function(id,name,url,type,index)
        {
               //alert("favorite"); 
               var fav={};
               fav.id=id;
               fav.name=name;
               fav.type=type;
               fav.url=url;
               //$scope.name=!$scope.name;
               //fav.url=url;
                    //console.log(fav);
               if(localStorage.getItem(id)===null){
                   localStorage.setItem(id,JSON.stringify(fav));
                  // $scope.myData["mark"]=1;
                   $scope.myData[index]["mark"]=1;
               }
               
               else{
                   $scope.myData[index]["mark"]=0;
                    localStorage.removeItem(id);
               }
               //alert("localstorage");
               //alert(fav.id);
               //alert(fav.name);
               //alert(fav.type);
              // alert(JSON.parse(localStorage.getItem('fav')));
               
          
        }
           $scope.funcfavtab=function()
        {
             
              $scope.favData={};
               for(var i=0;i<localStorage.length;i++)
                   {
                      var temp= JSON.parse(localStorage.getItem(localStorage.key(i)));
                       //console.log(temp.id);
    
                       $scope.favData[localStorage.key(i)]={name:temp.name,type:temp.type,url:temp.url,id:localStorage.key(i)};
                   }
               //console.log($scope.favData);
               
          $scope.secondpage=false;
            $scope.firstpage=false;
            $scope.favoritespage=true;
        }
           
           $scope.funcback=function(id,name,type)
        {
               //alert("favorite"); 
               var fav={};
               fav.id=id;
               fav.name=name;
               fav.type=type;
               //fav.url=url;
                    
               localStorage.setItem('fav',JSON.stringify(fav));
               //alert("localstorage");
               //alert(fav.id);
               //alert(fav.name);
               //alert(fav.type);
               //alert(JSON.parse(localStorage.getItem('fav')));
               
          
        }
           $scope.goBack=function()
        {
               $scope.firstpage=true;
               $scope.secondpage=false;          
          
        }
           
           
           $scope.deletefavfunc=function(id)
           {
               //console.log(localStorage.length);
               localStorage.removeItem(id);
               $scope.favData={};
               for(var i=0;i<localStorage.length;i++)
                   {
                      var temp= JSON.parse(localStorage.getItem(localStorage.key(i)));
                       //console.log(temp.id);
    
                       $scope.favData[localStorage.key(i)]={name:temp.name,type:temp.type,url:temp.url,id:localStorage.key(i)};
                   }
               //console.log($scope.favData);
               
           }
           

        
    });







/*

var app = angular.module('test', []);

      app.controller('test', function($scope, $http) {
          $scope.func1=function(){
      	alert(1)
          $scope.name="USC";
      	  $scope.names = ["Emil", "Tobias", "Linus"];
          }
      });*/

/*var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {

  $http.get("test.php").then(function (response) {
      $scope.myData = response.data;
      
  });
});*/