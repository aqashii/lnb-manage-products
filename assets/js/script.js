// function to get products from database
function getproductrow(product) {
  var productRow = "";
  if (product) {
    productRow = `<tr>
        
        <td><img src="uploads/${product.photo}"></td>
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
        <div class="d-flex">
            <a href="#" class="me-3 viewp"  
            data-bs-target="#viewpModal" data-id="${product.id}" title="View" data-bs-toggle="modal"><i class="fa-solid fa-eye text-success"></i></a>
            <a href="#" 
            data-bs-toggle="modal" data-bs-target="#editpModal" 
            class="me-3 editp" data-id="${product.id}" title="Edit" ><i class="fa-solid fa-pen-to-square text-info"></i></a>
            <a href="#" class="me-3 deletep" data-id="${product.id}" title="Delete" ><i class="fa-solid fa-trash-can text-danger"></i></a>
        </div>
        </td>

    </tr>`;
  }
  return productRow;
}

//function to get categories from database
function getCategoryRow(category) {
  var categoryRow = "";
  if (category) {
    categoryRow = `<tr>
    <th scope="row">${category.id}</th>
    <td>${category.name}</td>
    <td><button id="edit-btn" type="button" class="btn btn-primary" data-id="${category.id}" data-bs-toggle="modal" data-bs-target="#editCatModal">Edit</button>
        <button id="delete" type="button" class="btn btn-danger">Delete</button>

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
          // console.log(product);
        });

        $("#ptable tbody").html(productslist);
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
        $.each(rows.categories, function (index, category) {
          categorieslist += getCategoryRow(category);
        });
        $("#cat_table tbody").html(categorieslist);
      }
    },
    error: function () {
      console.log("Oops...something...");
    },
  });
}

$(document).ready(function () {
  console.log("document is ready loaded");

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
          // formdata.forEach(function(value, key) {
          //     console.log(key, value);
          // });
        },
        success: function (response) {
          console.log(response);
          if (response) {
            $("#addModal").modal("hide");
            $("#addform")[0].reset();
            getproducts();
          }
        },
        error: function (request, error) {
          console.log(arguments);
          console.log("Error :" + error);
        },
      });
    });
  } else if ($("#thispage").val() == "category-page") {
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
            getCategories();
          }
        },
        error: function (request, error) {
          console.log(arguments);
          console.log("Error :" + error);
        },
      });
    });
  }
});
