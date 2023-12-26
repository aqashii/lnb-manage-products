$(document).ready(function () {

    console.log("document is resdy loaded")
    //edit Product
    $(document).on("submit","#updateform",function(e){
    console.log("form is resdy loaded")
        e.preventDefault();
        // ajax
        $.ajax({
            url : "./pages/ajax.php",
            type : "POST",
            dataType : "json",
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