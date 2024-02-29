// function for pagination

function pagination(totalpages, currentpages) {
  var pagelist = "";
  if (totalpages > 1) {
    currentpages = parseInt(currentpages);
    pagelist += `<ul class="pagination justify-content-center">`;
    const prevClass = currentpages == 1 ? "disabled" : "";
    pagelist += `<li class="page-item ${prevClass}"><a class="page-link" href="#" data-pagenumber="${currentpages - 1}">Previous</a></li>`;

    for (let p = 1; p <= totalpages; p++) {
      const activeClass = currentpages == p ? "active" : "";
      pagelist += `<li class="page-item ${activeClass}"><a class="page-link" href="#" data-pagenumber="${p}">${p}</a></li>`;
    }


    const nextClass = currentpages == totalpages ? "disabled" : "";
    pagelist += `<li class="page-item ${nextClass}"><a class="page-link" href="#" data-pagenumber="${currentpages + 1}">Next</a></li>`;
    pagelist += `</ul>`;
  }

  $("#pagination").html(pagelist);

}


// function to get products from database
function getproductrow(product) {
  var productRow = "";
  if (product) {
    productRow = `<tr>
        
        <td><img src="uploads/${product.photo}"></td>
        <td>${product.name}</td>
        <td>${product.cat_id}</td>
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
        <div class="d-flex">
            <a href="#" class="me-3 viewp"  
            data-bs-target="#viewpModal" data-id="${product.id}" title="View" data-bs-toggle="modal"><i class="fa-solid fa-eye text-success"></i></a>
            <a href="#" 
            data-bs-toggle="modal" data-bs-target="#addModal" 
            class="me-3 editp" data-id="${product.id}" title="Edit" ><i class="fa-solid fa-pen-to-square text-info"></i></a>
            <a href="#" class="me-3 deletep" data-id="${product.id}" title="Delete" ><i class="fa-solid fa-trash-can text-danger"></i></a>
        </div>
        </td>

    </tr>`;
  }
  return productRow;
}

//function to get categories from database
function getCategoryRow(category, count) {
  var categoryRow = "";
  if (category) {
    categoryRow = `<tr>
    <th scope="row">${count}</th>
    <th scope="row">${category.id}</th>
    <td>${category.name}</td>
    <td><div class="d-flex">
            <a href="#" 
            data-bs-toggle="modal" data-bs-target="#addCategoryModal" 
            class="me-3 editcat" data-id="${category.id}" title="Edit" ><i class="fa-solid fa-pen-to-square text-info"></i></a>
            <a href="#" class="me-3 deletecat" data-id="${category.id}" title="Delete" ><i class="fa-solid fa-trash-can text-danger"></i></a>
        </div>

    </td>
</tr>`;
  }
  return categoryRow;
}

// get products
function getproducts() {
  var pageno = $("#currentpage").val();
  $.ajax({
    url: "./pages/ajax.php",
    type: "GET",
    dataType: "json",
    data: { page: pageno, action: "getallproducts" },
    beforeSend: function () {
      console.log("Waiting...");
    },
    success: function (rows) {
      console.log(rows);
      if (rows.players) {
        var productslist = "";
        $.each(rows.players, function (index, product) {
          productslist += getproductrow(product);
        });

        $("#ptable tbody").html(productslist);
        // console.log(rows.count);
        let totalproducts = rows.count;
        // console.log(totalproducts);
        let totalpages = Math.ceil(parseInt(totalproducts) / 4);
        // console.log(totalpages);
        const currentpages = $("#currentpage").val();
        pagination(totalpages, currentpages);
      }
    },
    error: function () {
      console.log("Oops...something");
    },
  });
}

// get categories
function getCategories() {
  var pageno = $("#currentpage").val();
  // ajax
  $.ajax({
    url: "./pages/ajax.php",
    type: "GET",
    dataType: "json",
    data: { page: pageno, action: "getallcategories" },
    beforeSend: function () {
      console.log("Categories is waiting....");
    },
    success: function (rows) {
      console.log(rows);
      if (rows.categories) {
        var categorieslist = "";
        var count = 1;
        $.each(rows.categories, function (index, category) {
          // console.log(index);
          categorieslist += getCategoryRow(category, count);
          count++;
        });
        $("#cat_table tbody").html(categorieslist);

        let totalproducts = rows.count;
        // console.log(totalproducts);
        let totalpages = Math.ceil(parseInt(totalproducts) / 4);
        // console.log(totalpages);
        const currentpages = $("#currentpage").val();
        pagination(totalpages, currentpages);
      }
    },
    error: function () {
      console.log("Oops...something...");
    },
  });
}

$(document).ready(function () {
  console.log("document is ready loaded");

  // toggle nav bar in responsive
  var menu = $(".menu");
  $("#toggle-btn").on("click", function () {
    // alert("heklo");
    menu.toggleClass('is-active');
  });

  // checking which page is loaded with hidden input value
  if ($("#thispage").val() == "manage-product") {
    //calling getproducts function
    getproducts();
    //Adding products
    $(document).on("submit", "#addform", function (event) {
      console.log("form is resdy loaded");
      event.preventDefault();
      // ajax
      $.ajax({
        url: "./pages/ajax.php",
        type: "POST",
        dataType: "json",
        data: new FormData(this),
        processData: false,
        contentType: false,
        beforeSend: function () {
          console.log("Waiting....Data..is..Loading");
          // var formdata = new FormData(document.getElementById("addform"));
          // console.log(formdata);
          // formdata.forEach(function(value, key) {
          //     console.log(key, value);
          // });
        },
        success: function (response) {
          // console.log(response);
          if (response) {
            $("#addModal").modal("hide");
            $("#addform")[0].reset();
            $(".displaymessage").removeClass("d-none").html(response.message).fadeIn().delay(2500).fadeOut();
            getproducts();
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(arguments);
          console.log("Error :" + textStatus, errorThrown);
        },
      });
    });
    getproducts();
    //on click event for pagination
    $(document).on("click", "ul.pagination li a", function (event) {
      event.preventDefault();
      const pagenum = $(this).data("pagenumber");

      $("#currentpage").val(pagenum);
      getproducts();
      // alert(1);
    });
    getproducts();

    // onclick event for Editing...
    $(document).on("click", "a.editp", function () {
      var pid = $(this).data("id");
      // alert(pid);

      $.ajax({
        url: "./pages/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "editproduct" },
        beforeSend: function () {
          console.log("Edit Waiting...");
        },
        success: function (rows) {
          console.log(rows);
          if (rows) {
            $("#modaltitle").html("Edit Product");
            $("#p_name").val(rows.name);
            $("#p_size").val(rows.size);
            $("#p_color").val(rows.color);
            $("#p_quality option[value='" + rows.quality_code + "']").attr("selected", "selected");
            $("#dropstatus option[value='" + rows.drop_status + "']").attr("selected", "selected");
            $("#sell_channel option[value='" + rows.sell_channel + "']").attr("selected", "selected");
            $("#soldstatus option[value='" + rows.sold_status + "']").attr("selected", "selected");
            $("#p_category option[value='" + rows.cat_id + "']").attr("selected", "selected");
            $("#p_brought_price").val(rows.brought_price);
            $("#p_sell_price").val(rows.sell_price);
            $("#p_sold_price").val(rows.sold_price);
            $("#p_sold_date").val(rows.sold_date);
            $("#productId").val(rows.id);
          }

        },
        error: function () {
          console.log("Oops...something");
        },
      });
    });

    // on click event for addnew Button
    $("#addNewBtn").on("click", function () {
      $("#modaltitle").html("Add New Product");
      $("#addform")[0].reset();
      $("#addform select").prop('selectedIndex', 0);
      $("#productId").val("");
    });

    //on click event for deleting product
    $(document).on("click", "a.deletep", function (e) {
      e.preventDefault();
      var pid = $(this).data("id");
      if (confirm("Are you sure want to delete this item...?")) {

        $.ajax({
          url: "./pages/ajax.php",
          type: "GET",
          dataType: "json",
          data: { id: pid, action: "deleteproduct" },
          beforeSend: function () {
            console.log("Deleting...");
          },
          success: function (res) {
            if (res.delete == 1) {
              $(".displaymessage").removeClass("d-none").html("Product was Deleted Successfull").fadeIn().delay(2500).fadeOut();
              getproducts();
              console.log("done......");
            }
          },
          error: function () {
            console.log("Oops...something");
          },



        });

      }
    });

    // on click event for view product 
    $(document).on("click", "a.viewp", function () {
      var pid = $(this).data("id");

      $.ajax({
        url: "./pages/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "editproduct" },
        beforeSend: function () {
          console.log("View Waiting...");
        },
        success: function (product) {
          console.log(product);

          const viewdata = `<div class="container">

          <div class="row">
              <div class="col-md-12 text-center">
                  <img src="uploads/${product.photo}">
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Name:</b>  ${product.name}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Category:</b>  ${product.cat_name}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Size:</b>  ${product.size}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Quality Code:</b>  ${product.quality_code}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Color:</b>  ${product.color}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Drop Status:</b>  ${product.drop_status}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Sell Channel:</b>  ${product.sell_channel}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Brought Price:</b>  ${product.brought_price}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Sell Price:</b>  ${product.sell_price}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Sold Status:</b>  ${product.sold_status}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Sold Price:</b>  ${product.sold_price}</label>
              
              </div>
              <div class="col-md-6">
              <label for="" class="form-label"><b>Sold Date:</b>  ${product.sold_date}</label>
              
              </div>

          </div>
      </div>`;
          $("#viewbody").html(viewdata);

        },
        error: function () {
          console.log("Oops...something");
        }

      });

    });

    // searching products
    $(document).on("keyup", function () {
      const searchText = $("#searchinput").val();
      console.log(searchText);
      if (searchText.length > 1) {

        $.ajax({
          url: "./pages/ajax.php",
          type: "GET",
          dataType: "json",
          data: { searchQuery: searchText, action: "searchproduct" },

          success: function (products) {
            if (products) {

              var productslist = "";

              $.each(products, function (index, product) {
                productslist += getproductrow(product);
              });
              $("#ptable tbody").html(productslist);
              $("#pagination").hide();
            }
          },
          error: function () {
            console.log("Oops...something");
          },

        });

      } else {
        getproducts();
        $("#pagination").show();

      }
    })

  }
  // END MANAGE PRODUCT PAGE FUNCTIONS


  // STARTED CATEGORY PAGE FUNCTIONS
  else if ($("#thispage").val() == "category-page") {
    console.log("category page is ready loaded");
    // call get all categories
    getCategories();
    //adding category
    $(document).on("submit", "#addCatForm", function (event) {
      console.log("Add category form is ready loaded");
      event.preventDefault();
      //   AJAX
      $.ajax({
        url: "./pages/ajax.php",
        type: "POST",
        dataType: "json",
        data: new FormData(this),
        processData: false,
        contentType: false,
        beforeSend: function () {
          console.log("Waiting....Data..is..Loading");
        },
        success: function (response) {
          console.log(response);
          if (response) {
            $("#addCategoryModal").modal("hide");
            $("#addCatForm")[0].reset();
            $(".displaymessage").removeClass("d-none").html(response.message).fadeIn().delay(2500).fadeOut();
            getCategories();
          }
        },
        error: function (request, error) {
          console.log(arguments);
          console.log("Error :" + error);
        },
      });
    });

    //on click event for pagination
    $(document).on("click", "ul.pagination li a", function (event) {
      event.preventDefault();
      const pagenum = $(this).data("pagenumber");

      $("#currentpage").val(pagenum);
      getCategories();
      // alert(1);
    });

    // On click event for edit category
    $(document).on("click", "a.editcat", function () {

      var catid = $(this).data('id');
      // alert(catid);

      $.ajax({
        url: "./pages/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: catid, action: "editcategory" },
        beforeSend: function () {
          console.log("Category Edit Waiting...");
        },
        success: function (response) {
          console.log(response);
          if (response) {
            $("#cname").val(response.name);
            $("#catId").val(response.id);
            $("#exampleModalLabel").html("Edit Category");
          }

        },
        error: function () {
          console.log("Oops...something");
        }

      });

    });

    // On click Event For click Add new button
    $("#AddNewBtn").on("click", function () {
      $("#exampleModalLabel").html("Add New Category");
      $("#addCatForm")[0].reset();
      $("#catId").val("");

    });

    // On click event for clicking delete icon
    $(document).on("click", "a.deletecat", function (event) {

      event.preventDefault();
      var catid = $(this).data("id");
      if (confirm("Are you sure want to delete this item...?")) {

        $.ajax({
          url: "./pages/ajax.php",
          type: "GET",
          dataType: "json",
          data: { id: catid, action: "deletecategory" },
          beforeSend: function () {
            console.log("Deleting...category:- " + catid);
          },
          success: function (response) {
            if (response.delete == 1) {
              $(".displaymessage").removeClass("d-none").html("Category was Deleted Successfull").fadeIn().delay(2500).fadeOut();
              getCategories();
              console.log("deleted..done....");
            }
          },
          error: function () {
            console.log("Oops...something");
          },
        });
      }
    });

        // searching Categories
        $(document).on("keyup", function () {
          const searchText = $("#searchinput").val();
          console.log(searchText);
          if (searchText.length > 1) {
    
            $.ajax({
              url: "./pages/ajax.php",
              type: "GET",
              dataType: "json",
              data: { searchQuery: searchText, action: "searchcategory" },
              beforeSend: function (){
                console.log("searching...")
              },
    
              success: function (categories) {
                if (categories) {
    
                  var categorieslist = "";
                  var count = 1;
                  $.each(categories, function (index, category) {
                    categorieslist += getCategoryRow(category,count);
                    count++;
                  });
                  $("#cat_table tbody").html(categorieslist);
                  $("#pagination").hide();
                }
              },
              error: function () {
                console.log("Oops...something");
              },
    
            });
    
          } else {
            getCategories();
            $("#pagination").show();
    
          }
        });
  }

  $("#logout-btn").on("click", function(){
    console.log("Logout...clicked");
    $.ajax({
      url:"./login/logout.php",
      type:"POST",

      success:function(){
        console.log("logouted...");
        setTimeout(function(){
          window.location = "./login";
        },2000);
      },
      error: function(xhr, status, error){
        // Handle error
        console.error(error);
    }
    })

  })
});
