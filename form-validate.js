$(document).ready(function () {
    jQuery.validator.addMethod("addressValidate", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\/\, ]+$/.test(value);
    });

    jQuery.validator.addMethod("alphanumeric", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
    });
    
    jQuery.validator.addMethod("creditcard", function (value, element) {
        return this.optional(element) || /^[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}$/.test(value);
    });
    
    jQuery.validator.addMethod("cvv", function (value, element) {
        return this.optional(element) || /^[0-9]{3}$/.test(value);
    });
    
    jQuery.validator.addMethod("expMon", function (value, element) {
        return this.optional(element) || /^([0-2][0-9]|(3)[0-1])\/[0-9]{2}$/.test(value);
    });
    
    jQuery.validator.addMethod("phoneNumber", function (value, element) {
        return this.optional(element) || /^[0-9]{10,12}$/.test(value);
    });



    $('#feedbackForm').validate({// initialize the plugin

        rules: {
            visaMon:{
                required: true,
                expMon:true
            },
            masterMon:{
                required: true,
                expMon:true
            },
            visaCvv:{
                required: true,
                cvv:true
            },
            masterCvv:{
                required: true,
                cvv:true
            },
            visaNo:{
                required: true,
                creditcard:true
            },
            masterNo:{
                required: true,
                creditcard:true
            },
            visa: {
                minlength: 4,
                required: true,
                alphanumeric: true,
                maxlength: 30
            },
            master: {
                minlength: 4,
                required: true,
                alphanumeric: true,
                maxlength: 30
            },
            name: {
                minlength: 4,
                required: true,
                alphanumeric: true,
                maxlength: 30
            },
            email: {
                required: true,
                email: true
            },
            phoneNum: {
                minlength: 10,
                maxlength: 12,
                phoneNumber:true
            },
            phoneNumCheck: {
                minlength: 10,
                required: true,
                maxlength: 12,
                phoneNumber:true
            },
            subject: {
                maxlength: 20
            },
            message: {
                required: true
            },
            address: {
                addressValidate: true
            },
            addressCheck: {
                addressValidate: true,
                required: true
            },
            city: {
                required: true
            }

        },
        messages: {
            visaMon:{
                required: "Expiry date cannot be blank",
                expMon:"Expiry date invalid eg:00/00"
            },
            masterMon:{
                required: "Expiry date cannot be blank",
                expMon:"Expiry date invalid eg:00/00"
            },
            visaCvv:{
                required: "Cvv cannot be blank",
                cvv:"Only 3 digits"
            },
            masterCvv:{
                required: "Cvv cannot be blank",
                cvv:"Only 3 digits"
            },
            visaNo:{
                required: "Card No cannot be blank D:< ",
                creditcard: "Not valid eg:0000-0000-0000-0000"
            },
            masterNo:{
                required: "Card No cannot be blank D:< ",
                creditcard: "Not valid eg:0000-0000-0000-0000"
            },
            visa: {
                required: "Name cannot be blank D:< ",
                minlength: "Name cannot be less than 4 characters D:<",
                alphanumeric: "Name must contain numbers and letters only D:<",
                maxlength: "Name cannot be longer than 30 characters"
            },
            master: {
                required: "Name cannot be blank D:< ",
                minlength: "Name cannot be less than 4 characters D:<",
                alphanumeric: "Name must contain numbers and letters only D:<",
                maxlength: "Name cannot be longer than 30 characters"
            },
            name: {
                required: "Name cannot be blank D:< ",
                minlength: "Name cannot be less than 4 characters D:<",
                alphanumeric: "Name must contain numbers and letters only D:<",
                maxlength: "Name cannot be longer than 30 characters"
            },
            email: {
                required: "Email cannot be blank D:<",
                email: "Invalid email format D:< eg: NoragamiS2pls@gmail.com"
            },
            phoneNum: {
                minlength: "Phone number must be atleast 10 digits D:< eg:0166874539",
                maxlength: "Phone Number cannot be longer than 12 digits",
                phoneNumber:"Digits only"
            },
            phoneNumCheck: {
                minlength: "Phone number must be atleast 10 digits D:< eg:0166874539",
                required: "Phone Number cannot be blank D:< ",
                maxlength: "Phone Number cannot be longer than 12 digits",
                phoneNumber:"Digits only"
            },
            subject: {
                maxlength: "Subject cannot be longer than 20 characters"
            },
            message: {
                required: "Message cannot be blank D:< "
            },
            address: {
                addressValidate: "address can only contain / , characters and digits only "
            },
            addressCheck: {
                addressValidate: "address can only contain / , characters and digits only ",
                required: "Address cannot be blank D:< "
            },
            city: {
                required: "Please select city"
            }

        }
    });


});