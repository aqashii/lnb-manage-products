
// function to get products from database
function getproductrow(product) {
    var productRow = "";
    if(product){
        productRow = `<tr>
        <td>${product.id}</td>
        <td>${product.cat_id}</td>
        <td>${product.name}</td>
        <td>${product.size}</td>
        <td>${product.quality_code}</td>
        <td>${product.color}</td>
        <td class="<?= $classBg2 ?>">${product.drop_status}</td>
        <td>${product.sell_channel}</td>
        <td>${product.brought_price}</td>
        <td>${product.sell_price}</td>
        <td class="<?= $classBg1 ?>">${product.sold_status}</td>
        <td>${product.sold_price}</td>
        <td>${product.sold_date}</td>
        <td>
            <a href="#" class="me-3 viewp"  
            data-bs-target="#viewpModal" title="View" data-bs-toggle="modal"><i class="fa-solid fa-eye text-success"></i></a>
            <a href="#" 
            data-bs-toggle="modal" data-bs-target="#editpModal" 
            class="me-3 editp" title="Edit" ><i class="fa-solid fa-pen-to-square text-info"></i></a>
            <a href="#" class="me-3 deletep" title="Delete" ><i class="fa-solid fa-trash-can text-danger"></i></a>

        </td>

    </tr>`;
    }
    return productRow;
}

// get products
function getproduct() {
    var pageno=$("#currentpage").val();
    $.ajax({
        url : "./pages/ajax.php",
        type : "GET",
        dataType : "json",
        data : {page:pageno,action:'getallproducts'},
        beforeSend : function(){
            console.log("Waiting...");
        },
        success : function (rows) {
            console.log(rows);
            if (rows) {
                var productslist = "";
                $.each(rows.players, function (index,product) {
                    productslist += getproductrow(product);
                });
                
                $("#ptable tbody").html(productslist);
            }
        },
        error : function(){
            
            console.log("Oops...something");
        }
    })
}
$(document).ready(function () {


    console.log("document is resdy loaded")
    //calling getproducts function 
    getproduct()
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