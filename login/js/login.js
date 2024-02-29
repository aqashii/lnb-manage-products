// $(document).on("submit", "#loginform", function(e) {
//     console.log("Submitted");
//     e.preventDefault();
//     $.ajax({
//         url: "./login.php",
//         type: "POST",
//         dataType: "json",
//         data: new FormData(this),
//         processData: false,
//         contentType: false,
//         beforeSend: function () {
//             console.log("Waiting....Data..is..Loading");
//         },
//         success:function(){
//             console.log("Success");
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log(arguments);
//             console.log("Error :" + textStatus, errorThrown);
//           },
//     });

// })

$(document).ready(function(){

$("#message-box").hide();



    $('#loginform').submit(function(e){
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize(); // Serialize form data

        // Perform Ajax request
        $.ajax({
            type: 'POST',
            url: './login.php',
            data: formData,
            dataType: 'json',   
            success: function(res){
                // Handle success response
                console.log(res);
                if(res.status == 0){
                    // alert("Invalid User!");
                    $("#message-box").addClass("error-msg").html("<i class='fa fa-times-circle'></i> Invalid User").fadeIn(1000).show();
                }else if(res.status == 1){
                    // alert("Login success");

                    $("#message-box").removeClass("error-msg").addClass("success-msg").html("<i class='fa fa-check'></i> Login Success..").fadeIn(1000).show();
                    setTimeout(function(){

                        window.location ='/';
                    },2000);
                }
            },
            error: function(xhr, status, error){
                // Handle error
                console.error(error);
            }
        });
    });
});