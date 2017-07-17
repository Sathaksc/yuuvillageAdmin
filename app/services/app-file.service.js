app.service('$appFile', ['$rootScope', '$http',
  function ($rootScope, $http) {
    console.log("testing..........");
    return {
      getConfig: function (callback) {
        $http.get('assets/config.json').success(function (data) {
          return callback(data);
        });
      },
      getAppVersion: function (callback) {
        $http.get('assets/version.json').success(function (data) {
          return callback(data);
        });
      },
      config: function (key_str, callback) {
        $http.get('assets/config.json').success(function (data) {
          var ret_data = null;
          if (key_str == '' || key_str == undefined || key_str === null)
            ret_data = data;
          else
            ret_data = data[key_str];

          return callback(false, ret_data);
        });
      }
    }
  }
]);