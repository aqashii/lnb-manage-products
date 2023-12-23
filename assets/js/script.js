$(document).ready(function () {

    // alert("fkdf");
    //edit Product
    $(document).on("submit","#updateform",function(e){
        e.preventDefault();
        // ajax
        $.ajax({
            url : "/pages/ajax.php",
            type : "POST",
            dataType : "Json",
            data : new FormData(this),
            processData : false,
            contentType : false,
            beforeSend : function(){
                console.log("Waiting....Data..is..Loading");
            },
            success : function(response){
                console.log(response);
            },
            error : function(request,error){
                console.log(arguments);
                console.log("Error :"+ error);

            }
        });
    });
});