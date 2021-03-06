$(function(){

$('#upassword').keyup(function() {
 checkStrength($(this));
});


 jQuery.validator.addMethod("properEmail", function(value, element) {
             var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

             return re.test(value);

         });

jQuery.validator.addMethod("onlyOne", function(value, element) {
             var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              if($("#ufmobile").val().length > 0)
              return true 
              else     
              return re.test(value);

         });


jQuery.validator.addMethod( "require_from_group", function( value, element, options ) {
	var $fields = $( options[ 1 ], element.form ),
		$fieldsFirst = $fields.eq( 0 ),
		validator = $fieldsFirst.data( "valid_req_grp" ) ? $fieldsFirst.data( "valid_req_grp" ) : $.extend( {}, this ),
		isValid = $fields.filter( function() {
			return validator.elementValue( this );
		} ).length >= options[ 0 ];

	// Store the cloned validator for future validation
	$fieldsFirst.data( "valid_req_grp", validator );

	// If element isn't being validated, run each require_from_group field's validation rules
	if ( !$( element ).data( "being_validated" ) ) {
		$fields.data( "being_validated", true );
		$fields.each( function() {
			validator.element( this );
		} );
		$fields.data( "being_validated", false );
	}
	return isValid;
}, jQuery.validator.format( "Please fill at least {0} of these fields." ) );




 var path1=baseurl+'front/checkunique';
 var path2=baseurl+'front/check_captcha';


  $("#signupForm").validate({
  	        ignore: "",
			rules: {
				fname: "required",
				lname: "required",
				upassword: {
					required: true,
					minlength: 5
				},
				uemail: {
					required: true,
					properEmail: true,
					remote : {
		                  url : path2,
		                  method: "post",
		                  data:{
		                    field: "email",
		                    value : function(){ return $("#uemail").val(); } 
		                  }   
		                } 
				},
				
				conditioncheck: {required: true}
			},
			messages: {
				fname: "Please enter your firstname",
				lname: "Please enter your lastname",
				upassword: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				uemail: {required:"Please enter your email address",properEmail:"Please enter a valid email address",remote:"Email address is taken"},
				conditioncheck: {required: "Please accept teams and conditions and privacy policy"}
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "conditioncheck")
				    {
                      error.appendTo( element.closest(".col-sm-1").next() );
				    }
				    else
				    {
				        error.insertAfter(element);
				    }
				}
			
		});



  $("#formSignIn").validate({
  	        ignore: "",
			rules: {
				spassword: {
					required: true
				},
				semail: {
					required: true,
					properEmail: true
				}
				
			},
			messages: {
				spassword: {
					required: "Please provide a password",
				},
				semail: {required:"Please enter your email address",properEmail:"Please enter a valid email address"},
			},
			errorPlacement: function(error, element) {
				error.insertAfter(element);
				}
			
		});



    $("#formForgotPwd").validate({
         rules: {
				userCaptcha: {
					required: true,
					remote : {
		                  url : path2,
		                  method: "post",
		                  data:{
		                    field: "userCaptcha",
		                    value : function(){ return $("#userCaptcha").val(); } 
		                  }   
		                } 
				},
				ufemail: {require_from_group: [1,".emph"],onlyOne: true},
				ufmobile: {require_from_group: [1,".emph"],number:true}
				
			},

	
			messages: {
				userCaptcha: {
					required: "Please provide a Captcha",
					remote : "Please enter correcr Captcha"
				},
				ufemail: {require_from_group:"Please enter your email address or mobile number",onlyOne:"Please enter valid email address"},
				ufmobile: {require_from_group:"Please enter your email address or mobile number",number:"Please enter valid mobile number"},
			},
			errorPlacement: function(error, element) {
				error.insertAfter(element);
				}

  		});
  


   $('.reload-captcha').click(function(event){
        event.preventDefault();
        var current=$(this);
        $.ajax({
           url:baseurl+'front/captcha',
           success:function(data){
              $('#captha_image').attr('src', data);
           }
        });            
    });



$( "#ufemail" ).on('focus keyup',function() {
	if($('#ufmobile').val().length > 0)
	{
      $('#ufmobile').val('');
	}
	$("#emph").val($('#ufemail').val());
	$("#resettext").text('SEND RESET LINK');  

});

$('#ufmobile').on('focus keyup',function(event){
	if($('#ufemail').val().length > 0)
	{
      $('#ufemail').val('');
	}	
 $("#emph").val($('#ufmobile').val());

  $("#resettext").text('SEND OTP');
});

$("#userCaptcha").focus(function(){

  if($('#ufemail').val().length > 0)
	{
      	$("#resettext").text('SEND RESET LINK');  
	}
	else
	{
	    $("#resettext").text('SEND OTP');	
	}	

});



});

function checkStrength(dataval) {
var password=dataval.val() ,strength = 0 ;

if (password.length > 5) strength += 1
// If password contains both lower and uppercase characters, increase strength value.
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
// If it has numbers and characters, increase strength value.
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
// If it has one special character, increase strength value.
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// If it has two special characters, increase strength value.
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// Calculated strength value, we can return messages
// If value is less than 2

	if(strength==0)
	{
		dataval.removeClass('short');
		dataval.removeClass('weakpwd');
		dataval.removeClass('goodpwd');
		dataval.removeClass('strongpwd');
	}
	else if (strength < 5) {
		dataval.removeClass('short');
		dataval.removeClass('goodpwd');
		dataval.removeClass('strongpwd');
		dataval.addClass('weakpwd');
	} else if (strength == 5) {
		dataval.removeClass('short');
		dataval.removeClass('weakpwd');
		dataval.removeClass('strongpwd');
		dataval.addClass('goodpwd');
	} else {
		dataval.removeClass('short');
		dataval.removeClass('weakpwd');
		dataval.removeClass('goodpwd');
		dataval.addClass('strongpwd');
	}
}


function showModalData(modal1,modal2)
{
  $("#"+modal2).modal('hide');
  $("#"+modal1).modal('show');

}