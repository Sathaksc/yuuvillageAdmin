app.factory('$apiService', function($dataService) {

return {
      user: {
        login: function (params, callback) {
          var hashPassword = CryptoJS.SHA1(params.password);
          var strHash = hashPassword.toString(CryptoJS.enc.Hex);
          var fields = {
            mobile_country_code: "+91",
            email_address: params.username,
            password: strHash
          };
          console.log("fields : ", fields);

          
          //$dataService.get("/api/user/profile/email/csatha@myicomp.com", function (err, result) {
          $dataService.post("/api/user/auth/login", fields, function (err, result) {
            return callback(false, result);
          });
      }
  }
}
  
});