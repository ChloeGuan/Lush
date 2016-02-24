 window.onload = function(){
              var subBut = document.getElementById("submit");
              
                var signUp = function(){
                  jQuery.ajax({
                      url: "http://localhost:8888/lushApp/lushAppServer/controller/userControl.php",
                      type: "POST",
                      dataType: "json",
                      data: {
                          signUp: true,
                          username: document.getElementById("username").value,
                          password: document.getElementById("password").value,
                          email: document.getElementById("email").value,
                          displayname: document.getElementById("displayname").value
                      },
                      success: function(res){
                          console.log(res);
                      },
                      error: function(err){
                          console.log(err);
                      }
                      
                  });
              };
                
              subBut.onclick = function(){
                  signUp();
              };
                
            }
            
            