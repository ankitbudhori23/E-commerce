
function an(){
  document.getElementById("box").style.display = "none";
}

function signinerror(){
Swal.fire({
icon: 'error',
title: 'Sign in failed wrong user credentials!',
})
}

function placerror(){
Swal.fire({
  title: 'Sign in to Continue!',
  icon: 'error',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sign In'
}).then((result) => {
  if (result.isConfirmed) {
        document.getElementById("signinform").style.display = "block";
  }
})
}

function wishlistlogin(){
  Swal.fire({
    text: 'Please Sign in for wishlisting a product!',
    icon: 'error',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sign In'
  }).then((result) => {
    if (result.isConfirmed) {
          document.getElementById("signinform").style.display = "block";
    }
  })
  }

function emailexist(){
Swal.fire({
icon: 'error',
title: 'The email address you have entered is already registered!',
})
}


function phoneexist(){
Swal.fire({
icon: 'error',
title: 'This Mobile Number is already registered! Try Different',
})
}

function feedback_submit(){
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: 'Thank you for getting in touch!',
})
}

function news_letter(){
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: 'You have Successfully Subscribed to Our Newsletters!',
  footer:'Check Your Email for more Details'
})
}

                 
                 // preloader
window.onload=function(){
  document.getElementById('loader').style.display="none";
  document.getElementById('content').style.display="block";
};  


                 // Banner of offers

function banner(){
  document.getElementById("banner").style.display = "block";
}

function closebanner() {
  document.getElementById("banner").style.display = "none";
  }
                    
                    
                    // Sign-in Box
function signinpopup() {
      document.getElementById("signinform").style.display = "block";
    }
    
function closesignin() {
    document.getElementById("signinform").style.display = "none";
    }

function signuppopup() {
    document.getElementById("signupform").style.display = "block";
    }
    
function closesignup() {
      document.getElementById("signupform").style.display = "none";
    }



                          // Validation for sign IN Form

    function validatesignin() {
      
      if( document.signinform.email.value == "" ) {
        document.getElementById('loginemail').style.border = "2px solid red";
        document.getElementById('loginemail').style.background="#f5bebe";
        document.signinform.email.focus() ;
         return false;   
      }

       if( document.signinform.password.value == "" ) {
        document.getElementById('loginpass').style.border = "2px solid red";
        document.getElementById('loginpass').style.background="#f5bebe";
         document.signinform.password.focus() ;
         return false;
      }
      
    }


    var lemail = function() {
      if (document.signinform.email.value.length < 5 ){
        document.getElementById('loginemail').style.border = "2px solid red";
        document.getElementById('loginemail').style.boxShadow = "0 0 6px red ";
        document.getElementById('loginemail').style.backgroundColor = "white";
      } 
      else if(document.signinform.email.value.length > 5 ){
        document.getElementById('loginemail').style.border = "2px solid green";
        document.getElementById('loginemail').style.boxShadow = "0 0 6px green ";
        document.getElementById('loginemail').style.backgroundColor = "white";
      } 
    }



    var pass = function() {
        if(document.signinform.password.value.length < 3 ){
      document.getElementById('loginpass').style.border = "2px solid red";
      document.getElementById('loginpass').style.boxShadow = "0 0 6px red ";
      document.getElementById('loginpass').style.backgroundColor = "white";
    }
    else if(document.signinform.password.value.length > 3 ){
      document.getElementById('loginpass').style.border = "2px solid green";
      document.getElementById('loginpass').style.boxShadow = "0 0 6px green ";
      document.getElementById('loginpass').style.backgroundColor = "white";
    }
  }
  
    function forgetpass(){
       Swal.fire({
        title: 'Input email address',
        input: 'email',
        inputLabel: 'Your email address',
        inputPlaceholder: 'Enter your email address'
      })
   }
 
                    // Validation for Sign UP Form 

    function validatesignup() {
      
      if( document.signupform.fname.value == "" ) {
        document.getElementById('signupfname').style.border = "2px solid red";
        document.getElementById('signupfname').style.background="#f5bebe";
        document.signupform.fname.focus() ;
         return false;   
      }

	if( document.signupform.lname.value == "" ) {
        document.getElementById('signuplname').style.border = "2px solid red";
        document.getElementById('signuplname').style.background="#f5bebe";
        document.signupform.lname.focus() ;
         return false;   
      }
      

      if( document.signupform.email.value == "" ) {
        document.getElementById('signupemail').style.border = "2px solid red";
        document.getElementById('signupemail').style.background="#f5bebe";
         document.signupform.email.focus() ;
         return false;
      }
        if( document.signupform.phone.value == "" ) {
          document.getElementById('signupmobile').style.border = "2px solid red";
          document.getElementById('signupmobile').style.background="#f5bebe";
       document.signupform.phone.focus() ;
        return false;   
      }
          else if(document.signupform.phone.value.length < 10) {
            
              Swal.fire({
                text: 'Invalid Mobile Number!',
                icon: 'error',
                confirmButtonText: ' OK '
              })
            
            document.signupform.phone.focus() ;
          return false;
        }
        else if(document.signupform.phone.value.length > 10) {
          Swal.fire({
            text: 'Invalid Mobile Number!',
            icon: 'error',
            confirmButtonText: ' OK '
          })
          document.signupform.phone.focus() ;
        return false;
      }



       if( document.signupform.password.value == "" ) {
        document.getElementById('password').style.border = "2px solid red";
        document.getElementById('password').style.background="#f5bebe";
     document.signupform.password.focus() ;
      return false;   
      }
      else if(document.signupform.password.value.length < 6) {
        Swal.fire({
          text: 'Password must contain at least six characters!',
          icon: 'error',
          confirmButtonText: ' OK '
        })
        
        document.signupform.password.focus() ;
        return false;
      }

      if( document.signupform.confirmpassword.value == "" ) {
        document.getElementById('cpassword').style.border = "2px solid red";
        document.getElementById('cpassword').style.background="#f5bebe";
         document.signupform.confirmpassword.focus() ;
         return false; 
          }
         else if(document.signupform.confirmpassword.value !== document.signupform.password.value)
         { 
          Swal.fire({
            text: 'Password are not Matching!',
            icon: 'error',
            confirmButtonText: ' OK '
          })
           
         document.signupform.confirmpassword.focus() ;
         return false;
          
      }
}

                    // for Signup name
  var upfname = function() {
  if(document.signupform.fname.value.length < 2 ){
  document.getElementById('signupfname').style.border = "1px solid red";
  document.getElementById('signupfname').style.boxShadow = "0 0 6px red ";
  document.getElementById('signupfname').style.backgroundColor = "white";
   }
   else if(document.signupform.fname.value.length > 2 ){
    document.getElementById('signupfname').style.border = "1px solid green";
   document.getElementById('signupfname').style.boxShadow = "0 0 6px green ";
     document.getElementById('signupfname').style.backgroundColor = "white";
    }
   }

   var uplname = function() {
    if(document.signupform.lname.value.length < 2 ){
    document.getElementById('signuplname').style.border = "1px solid red";
    document.getElementById('signuplname').style.boxShadow = "0 0 6px red ";
    document.getElementById('signuplname').style.backgroundColor = "white";
     }
     else if(document.signupform.lname.value.length > 2 ){
      document.getElementById('signuplname').style.border = "1px solid green";
     document.getElementById('signuplname').style.boxShadow = "0 0 6px green ";
       document.getElementById('signuplname').style.backgroundColor = "white";
      }
     }

                      // for Signup email
  var upemail = function() {
    if(document.signupform.email.value.length < 6 ){
    document.getElementById('signupemail').style.border = "1px solid red";
    document.getElementById('signupemail').style.boxShadow = "0 0 6px red ";
    document.getElementById('signupemail').style.backgroundColor = "white";
     }
     else if(document.signupform.email.value.length > 6 ){
      document.getElementById('signupemail').style.border = "1px solid green";
     document.getElementById('signupemail').style.boxShadow = "0 0 6px green ";
       document.getElementById('signupemail').style.backgroundColor = "white";
      }
     }

                        // for Signup mobile
  var upmobile = function() {
    if(document.signupform.phone.value.length <=9 ){
    document.getElementById('signupmobile').style.border = "1px solid red";
    document.getElementById('signupmobile').style.boxShadow = "0 0 6px red ";
    document.getElementById('signupmobile').style.backgroundColor = "white";
    }
    else if(document.signupform.phone.value.length == 10){
      document.getElementById('signupmobile').style.border = "1px solid green";
     document.getElementById('signupmobile').style.boxShadow = "0 0 6px green ";
       document.getElementById('signumobile').style.backgroundColor = "white";
      }
      else if(document.signupform.phone.value.length > 10){
        document.getElementById('signupmobile').style.border = "1px solid red";
    document.getElementById('signupmobile').style.boxShadow = "0 0 6px red ";
    document.getElementById('signupmobile').style.backgroundColor = "white";
        }
     }
                      // Validation for password

var passcheck = function() {
    if(document.signupform.password.value.length < 6 ){
    document.getElementById('password').style.border = "1px solid red";
    document.getElementById('password').style.boxShadow = "0 0 6px red ";
    document.getElementById('password').style.backgroundColor = "white";
     }
     else if(document.signupform.password.value.length >= 6 ){
      document.getElementById('password').style.border = "1px solid green";
     document.getElementById('password').style.boxShadow = "0 0 6px green ";
       document.getElementById('password').style.backgroundColor = "white";
      }
     }              

  var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('cpassword').value) {
      document.getElementById('cpassword').style.border = "1px solid green";
      document.getElementById('cpassword').style.boxShadow = "0 0 6px green ";
      document.getElementById('cpassword').style.backgroundColor = "white";
    document.getElementById('password-message').style.color = 'green';
    document.getElementById('password-message').style.background = '#6eea70';
    document.getElementById('password-message').innerHTML = 'Password are Matching';
  } else {
    document.getElementById('cpassword').style.border = "1px solid red";
    document.getElementById('cpassword').style.boxShadow = "0 0 6px red ";
    document.getElementById('cpassword').style.backgroundColor = "white";
    document.getElementById('password-message').style.color = 'red';
    document.getElementById('password-message').style.background = '#f5bebe';
    document.getElementById('password-message').innerHTML = 'Password are not Matching';
  }
}


$(document).ready(function(){
  $('.radioBtn').click(function(){
       var target = $(this).data('target-id');
      $('.my-div').hide(); 
      $('.my-div[data-target="'+target+'"]').show();  
  }); 
}); 

      
function generateCaptcha(){
  var alpha = new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
  var i;
  for (i=0;i<4;i++){
    var a = alpha[Math.floor(Math.random() * alpha.length)];
    var b = alpha[Math.floor(Math.random() * alpha.length)];
    var c = alpha[Math.floor(Math.random() * alpha.length)];
    var d = alpha[Math.floor(Math.random() * alpha.length)];
   }
 var code = a + '' + b + '' + '' + c + '' + d;
 document.getElementById("mainCaptcha").value = code
}
function CheckValidCaptcha(){
   var string1 = removeSpaces(document.getElementById('mainCaptcha').value);
   var string2 = removeSpaces(document.getElementById('txtInput').value);
   if (string1 == string2){
document.getElementById('s').innerHTML = "Captcha matched! <br>";
document.getElementById('s').style.color="green ";
document.getElementById('s').style.backgroundColor="#bdf7b4";
document.getElementById('s').style.padding="10px 30px";
document.getElementById('s').style.marginLeft="150px";
location.replace("thank-you.php")
     return true;
   }
   else{       
document.getElementById('s').innerHTML = "Please Enter a Valid Captcha! <br>"; 
document.getElementById('s').style.backgroundColor="#ffcccc";
document.getElementById('s').style.padding="10px 30px";
document.getElementById('s').style.marginLeft="100px";

     return false;

   }
}
function removeSpaces(string){
 return string.split(' ').join('');
}

    


function pay_now(){
 var email=jQuery('#email').val();   
 var name=jQuery('#name').val(); 
 var phone=jQuery('#phone').val();      
 var amt=jQuery('#amt').val();       
    jQuery.ajax({
     type:'post',            
    url:'pay.php',             
     data:"amt="+amt+"&email="+email+"&name="+name+"&phone="+phone,           
     success:function(result){                
    var options = {                      
    "key": "rzp_test_9TKMkkLa0CL89f",                       
    "amount": amt*100,                     
    "currency": "INR",               
    "name": "Rent Bazar",                     
    "description":"Rent & Relax!",
      "image": "https://1.bp.blogspot.com/-TO3HQY8SMTc/YUrignYIQiI/AAAAAAAAkt4/XjDjYtzR_-4cFuX26iUD0wA1Ll_dQAFbwCLcBGAsYHQ/s467/rent1.png",   
    "theme.color":"#37cc9e",   
    "prefill.contact":phone,      
    "prefill.email":email,              
    "handler": function (response){
                               
    jQuery.ajax({
     type:'post',
                                   
    url:'pay.php',
                                   data:"payment_id="+response.razorpay_payment_id,
                                   success:function(result){
                                       window.location.href="thank-you.php";
                                   
    }        
    });               
    }             
    };               
    var rzp1 = new Razorpay(options);               
    rzp1.open();           
    }       
    });   
    }


function mouseDown() {
  document.getElementById("mouse-btn").style.width = "100px";
  document.getElementById("mouse-btn").style.height = "60px";
  document.getElementById("mouse-btn").style.marginLeft = "60px";
  document.getElementById("mouse-btn").style.marginTop = "5px";
  document.getElementById("mouse-btn").style.backgroundColor = "green";
  document.getElementById("mouse-btn").style.color = "white";
  document.getElementById("mouse-btn").style.transition = "all .1s";
}

function mouseUp() {
   document.getElementById("mouse-btn").style.width = "120px";  document.getElementById("mouse-btn").style.height = "70px";
   document.getElementById("mouse-btn").style.marginLeft = "50px";
   document.getElementById("mouse-btn").style.marginTop = "0px";
    document.getElementById("mouse-btn").style.backgroundColor = "pink";
     document.getElementById("mouse-btn").style.color = "black";
}
  
                              // my-account

function changepass(){
  if(document.changep.newpass.value !==
  document.changep.cnewpass.value)
  {
    Swal.fire({
        text: 'Password and Confirm Password does not Match!',
        icon: 'error',
        confirmButtonText: ' OK '
      })
document.changep.cnewpass.focus(); 
return false;
  }
  if (document.changep.newpass.value.length &&
    document.changep.cnewpass.value.length < 6)
    {
      Swal.fire({
        text: 'Password must contains 6 Characters!',
        icon: 'error',
        confirmButtonText: ' OK '
      })
document.changep.cnewpass.focus(); 
return false;
  }
  return true;
}

function passchanged(){
  Swal.fire({
    icon: 'success',
    text: 'Password Changed Successfully!',
    confirmButtonText: ' OK '
  })
}


function currentpassnot(){
  Swal.fire({
    text: 'Your Current Password is Incorrect!',
    icon: 'error',
    confirmButtonText: ' OK '
  })
}


function personalinfo(){
  Swal.fire({
    text: 'Personal Information Updated!',
    icon: 'success',
    confirmButtonText: ' OK '
  })

}

function searcherror(){
      if( document.searchform.searchproducts.value == "") {
        document.getElementById('searchpro').style.border = "2px solid red";
        document.getElementById('searchpro').style.background="#b1aaaa6b";
        document.searchform.searchproducts.focus() ;
         return false;   
      }
}

// $(document).ready(function(){
//   $('#sendfeedbtn').click(function(){
    

//      $.post("rentbazar.php",{
//        name=$("# ").val(),
//        email=$("# ").val(),
//        =$("# ").val(),
//        =$("# ").val()

//      },function(data){
//        $("")
//      }
//      )
//     })
// })