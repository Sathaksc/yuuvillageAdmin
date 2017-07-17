app.service('$dataService', ['$http', '$rootScope', '$window','$appFile',
  function ($http, $rootScope, $window, $appFile) {

    return {
      get: function (url, callback, cache) {
        var opts = {
          headers: {}
        };

        //var authtoken = $rootScope.temporary_user_auth_token;
        var authtoken ="aa03ca0f9c0de37efcbae11d32f646f8f42ba5e4db17dc4ee960427535fe23c1683bd86b0d9c7a4e70830e30e166841c";
        if ($rootScope.currentUser && $rootScope.currentUser.id) {
          authtoken = $rootScope.user_auth_token;
        } else {
          if (window.localStorage['user_auth_token'] !== undefined) {
            authtoken = window.localStorage['user_auth_token'];
            $rootScope.currentUser = JSON.parse(window.localStorage['currentUser']);
          }
        }

        opts.headers["x-yz-authtoken"] = authtoken;
        opts.headers["x-yz-html5app"] = $rootScope.appHeader;
        if (url.match("socialcommerce-subscription")) {
          opts.headers["x-yz-api-ver"] = "1.1";
        }

        opts.cache = cache != undefined ? cache : true;
      var api_domain ='http://www.yuuvillage.com';
            url = api_domain + url;
            var api_domain_url = api_domain;
            var domain_header = api_domain_url.split("//");
            opts.headers["x-yz-host"] = domain_header[1];
            console.log("DATA GET : " + url);

            
            console.log("url :", url);
            $http.get(url, opts).success(function (data, status) {
              var dataResult = data;
              var statusResult = data.status;

              return callback(statusResult, dataResult);
            }).error(function (data, status) {
              var errorResult = {
                code: "error",
                message: status
              };
              return callback(errorResult, status);
            });
      },


      post: function (url, fields, callback) {
        var opts = {
          headers: {}
        };

        var authtoken = $rootScope.temporary_user_auth_token;
        if ($rootScope.currentUser && $rootScope.currentUser.id) {
          authtoken = $rootScope.user_auth_token;
        } else {
          if (window.localStorage['user_auth_token'] !== undefined) {
            authtoken = window.localStorage['user_auth_token'];
            $rootScope.currentUser = JSON.parse(window.localStorage['currentUser']);
          }
        }
        $rootScope.appHeader="";
        opts.headers["x-yz-authtoken"] = authtoken;
        opts.headers["x-yz-html5app"] = $rootScope.appHeader;
        
        //$appFile.config('api_domain', function (err, api_domain) {
        //  if (!_.isNull(api_domain)) {
            var api_domain ='http://www.yuuvillage.com';
            url = api_domain + url;
            var api_domain_url = api_domain;
            var domain_header = api_domain_url.split("//");
            opts.headers["x-yz-host"] = domain_header[1];

opts.headers ["Access-Control-Allow-Origin"] = "*";
        opts.headers ["Access-Control-Allow-Methods"] = "*";
        opts.headers ["Access-Control-Allow-Headers"] = "*";


            console.log("DATA POST opts: ", opts);
            console.log("DATA POST fields: ", fields);
            console.log("DATA POST url: ", url);
           //return callback(true, 'status', 'data');
            
            $http.post(url, fields, opts).success(function (data, status) {
              var dataResult = data;
              var statusResult = data.status;
              //$rootScope.comm_busy = false;
              return callback(statusResult, dataResult);
            }).error(function (data, status) {
              //$rootScope.comm_busy = false;
              console.log('POST Error response :- ', JSON.stringify(data));
              return callback(true, status, data);
            });
            
          //}
        //});
        

      }
    };
  }
]);

