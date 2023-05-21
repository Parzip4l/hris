// npm package: jquery-validation
// github link: https://github.com/jquery-validation/jquery-validation

$(function() {
  'use strict';
  $(function() {
    // validate signup form on keyup and submit
    $("#signupForm").validate({
      rules: {
        nama: {
          required: true,
          minlength: 3
        },
        ktp: {
          required: true,
          maxlength: 17
        },
        nik: {
          required: true,
          minlength: 3
        },
        email: {
          required: true,
          email: true
        },
        age_select: {
          required: true
        },
        gender_radio: {
          required: true
        },
        skill_check: {
          required: true
        },
        password: {
          required: true,
          minlength: 5
        },
        confirm_password: {
          required: true,
          minlength: 5,
          equalTo: "#password"
        },
        terms_agree: "required"
      },
      messages: {
        nama: {
          required: "Please enter a name",
          minlength: "Name must consist of at least 3 characters"
        },
        ktp: "Please enter a Citizen ID",
        nik: "Please enter a Kode Karyawan",
        email: "Please enter a valid email address",
        age_select: "Please select your age",
        skill_check: "Please select your skills",
        gender_radio: "Please select your gender",
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        confirm_password: {
          required: "Please confirm your password",
          minlength: "Your password must be at least 5 characters long",
          equalTo: "Please enter the same password as above"
        },
        terms_agree: "Please agree to terms and conditions"
      },
      errorPlacement: function(error, element) {
        error.addClass( "invalid-feedback" );

        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        }
        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
          error.insertAfter(element.parent().parent());
        }
        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
          error.appendTo(element.parent().parent());
        }
        else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        }
      },
      unhighlight: function(element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
      }
    });
  });
});