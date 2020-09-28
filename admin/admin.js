$(document).ready(function(){

    //username check
    function verify_username(name) {
        $.ajax({
            url:"op/process.php",
            method:"POST",
            data:{check_username:1,username:name},
            success: function (data) {
                $('#uname_error').html(data);
            }
        })
    }
    $('#username').blur(function () {
        if($(this).val() == ''){
            $(this).addClass('border-danger');
            $('#uname_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            $(this).removeClass('border-danger');
            $('#uname_error').html("");
            var username = $(this).val();
            verify_username(username);
        }
    });
    //email check
    function verify_email(email) {
        $('.e_error').text('');
        $.ajax({
            url : "op/process.php",
            method  : "POST",
            data : {check_email:1,email:email},
            success : function(data){
                if(data == "already_exists"){
                    $(this).addClass('border-danger');
                    $('#email_error').html("<span class='text-danger'>Already exists !!</span>");
                }else if(data == "invalid_email"){
                    $(this).addClass('border-danger');
                    $('#email_error').html("<span class='text-danger'>Invalid Email !!</span>");
                }else if(data == "ok"){
                    $("#email_error").html("<span class='text-success'>OK</span>");
                }
            }
        })
    }

    $('#email').blur(function () {
        if($(this).val() == ''){
            $(this).addClass('border-danger');
            $('#email_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            $(this).removeClass('border-danger');
            $('#email_error').html("");
            var email = $(this).val();
            verify_email(email);
        }
    });

    $('#reg_form').on("submit",function () {
        var fullname = $('#fullname');
        var username = $('#username');
        var email = $('#email');
        var pass1  = $('#pass1');
        var pass2 = $('#pass2');
        var status = false;
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

        if(fullname.val() == ''){
            fullname.addClass('border-danger');
            $('#fname_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            if(fullname.val().length <6){
                fullname.addClass('border-danger');
                $('#fname_error').html("<span class='text-danger'>Name should be more than 6 character!!</span>");
            }else {
                fullname.removeClass('border-danger');
                $('#fname_error').html('');
                status = true;
            }
        }
        if(username.val() == ''){
            username.addClass('border-danger');
            $('#uname_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            username.removeClass('border-danger');
            $('#uname_error').html('');
            status = true;
        }
        if(email.val() == ''){
            email.addClass('border-danger');
            $('#email_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            if (!e_patt.test(email.val())) {
                email.addClass('border-danger');
                $('#email_error').html("<span class='text-danger'>Please enter valid email!!</span>");
            } else {
                email.removeClass('border-danger');
                $('#email_error').html('');
                status = true;
            }
        }

        if(pass1.val() == "" || pass1.val().length < 6){
            pass1.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
            status = false;
        }else{
            pass1.removeClass("border-danger");
            $("#p1_error").html("");
            status = true;
        }
        if(pass2.val() == "" || pass2.val().length < 6){
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
            status = false;
        }else{
            pass2.removeClass("border-danger");
            $("#p2_error").html("");
            status = true;
        }

        if ((pass1.val() == pass2.val()) && status == true) {
            $.ajax({
                url:"op/process.php",
                method : "POST",
                data : $("#reg_form").serialize(),
                success : function(data){
                    if(data == 'INSERTED_USER'){
                        window.location.href = "login.php?success_mgs=You are registered Now you can login ";
                    }else {
                        window.location.href ="registration.php?fail_mgs=Sorry! Something is wrong!";
                    }
                }

            })
        }else{
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Password not Match!!!</span>");
            status = false;
        }
    });
    // LOGIN PART

    $('#login_form').on("submit",function () {
        var email = $('#log_email');
        var pass = $('#password');
        var status = false;
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

        if(email.val() == ''){
            email.addClass('border-danger');
            $('#log_email_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            if (!e_patt.test(email.val())) {
                email.addClass('border-danger');
                $('#log_email_error').html("<span class='text-danger'>Please enter valid email!!</span>");
            } else {
                email.removeClass('border-danger');
                $('#log_email_error').html('');
                status = true;
            }
        }

        if(pass.val() == ""){
            pass.addClass("border-danger");
            $("#log_pass_error").html("<span class='text-danger'>Field must not be empty!!</span>");
            status = false;
        }else{
            pass.removeClass("border-danger");
            $("#log_pass_error").html("");
            status = true;
        }

        if(status){
            $(".overlay").show();
            $.ajax({
                url:"op/process.php",
                method : "POST",
                data : $("#login_form").serialize(),
                success : function(data){
                    if(data == "invalid_email"){
                        email.addClass('border-danger');
                        $('#log_email_error').html("<span class='text-danger'>Invalid Email!!</span>");
                    }else if(data == "NOT_REGISTER"){
                        email.addClass('border-danger');
                        $('#log_email_error').html("<span class='text-danger'>It seems like you are not registered !!</span>");
                    }else if(data == 'PASSWORD_NOT_MATCH') {
                        pass.addClass('border-danger');
                        $('#log_pass_error').html("<span class='text-danger'>Password Not Match!</span>");
                    }else if(data == 'SUCCESS_LOGIN'){
                        window.location.href ="index.php";
                    }
                }

            })
        }
    });

    //Add Category
    $("#add_cat_form").on("submit",function(){
        if ($("#catname").val() == "") {
            $("#catname").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        }else {
            $("#catname").removeClass("border-danger");
            $("#cat_error").html("");
            $.ajax({
                url:"op/process.php",
                method : "POST",
                data  : $("#add_cat_form").serialize(),
                success : function(data){
                    if(data == 'EXISTS'){
                        $("#catname").addClass("border-danger");
                        $("#cat_error").html("<span class='text-danger'>Category Already exist!!</span>");
                    }else if(data == 'INSERTED_CATEGORY'){
                        $("#catname").val("");
                        //  $("#cat_error").html("<span class='text-success'>Category Added Successfully!!</span>");
                        fetch_category();
                        swal_add_cat();
                    }else {
                        alert(data);
                    }

                }
            })
        }
    });

    //Add Brand
    $("#add_brand_form").on("submit",function(){
        if ($("#brandname").val() == "") {
            $("#brandname").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        }else{
            $.ajax({
                url:"op/process.php",
                method : "POST",
                data : $("#add_brand_form").serialize(),
                success : function(data){
                    if (data == "INSERTED_BRAND") {
                        $("#brandname").removeClass("border-danger");
                        $("#brandname").val("");
                        fetch_brand();
                        swal_add_brand();
                    }else if(data == "EXISTS"){
                        $("#brandname").addClass("border-danger");
                        $('#brand_error').html("");
                        alert("It seems like you Brand is already used");
                    }
                    else{
                        alert(data);
                    }
                }
            })
        }
    });
    //manage category

    manageCategory(1);
    function manageCategory(pn){
        $.ajax({
            url:"op/process.php",
            method : "POST",
            data : {manageCategory:1,pageno:pn},
            success : function(data){
                $("#get_category").html(data);
            }
        })
    }
    var cat_auto_load = setInterval(function () {
        manageCategory(1);
    },500);

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageCategory(pn);
        clearInterval(cat_auto_load);

    });

    //DELETE CAT
    $("body").delegate(".del_cat","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure ? You want to delete..!")) {
            $.ajax({
                url:"op/process.php",
                method : "POST",
                data : {deleteCategory:1,id:did},
                success : function(data){
                    if (data == "DEPENDENT_CATEGORY") {
                        swal_not_delete_cat_parent();
                        //alert("Sorry ! this Category is dependent on other sub categories");
                    }else if(data == "CATEGORY_DELETED"){
                        swal_delete_cat();
                        manageCategory(1);
                        //$('#categoryModal').modal('toggle');
                    }else if(data == "DELETED"){
                        alert("Deleted Successfully");
                    }else{
                        alert(data);
                    }
                }
            })
        }else{

        }
    });


    //Update Category
    $("body").delegate(".edit_cat","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : "op/process.php",
            method : "POST",
            dataType : "json",
            data : {updateCategory:1,id:eid},
            success : function(data){
                console.log(data);
                $("#cid").val(data["cat_id"]);
                $("#update_category_name").val(data["catname"]);
                $("#p_cat").val(data["parent_cat"]);
            }
        })

    });
    //update cat
    $("#update_category_form").on("submit",function(){
        if ($("#update_category").val() == "") {
            $("#update_category").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        }else{
            $.ajax({
                url : "op/process.php",
                method : "POST",
                data  : $("#update_category_form").serialize(),
                success : function(data){
                    if(data == 'UPDATED'){
                        swal_update_cat();
                        $('#categoryModal').modal('toggle');
                    }else if(data == 'NOT_UPDATED'){
                        swal_not_update();
                    }

                }
            })
        }
    });
    //Fetch category
    fetch_category();
    function fetch_category(){
        $.ajax({
            url:"op/process.php",
            method : "POST",
            data : {getCategory:1},
            success : function(data){
                var root = "<option value='0'>Root</option>";
                var choose = "<option value=''>Choose Category</option>";
                $("#parent_cat").html(root+data);
                $("#select_cat").html(choose+data);
                $("#u_cat").html(choose+data);
                $("#front_categories").html(data);
            }
        })
    };

    fetch_cat();
    function fetch_cat(){
        $.ajax({
            url:"op/process.php",
            method : "POST",
            data : {getCategory:1},
            success : function(data){
                var root = "<option value='0'>Root</option>";
                var choose = "<option value=''>Choose Category</option>";
                $("#p_cat").html(root+data);
            }
        })
    };

    ///manage brand
    manageBrand(1);
    function manageBrand(pn){
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {manageBrand:1,pageno:pn},
            success : function(data){
                $("#get_brand").html(data);
            }
        })
    }
    var brand_auto_load = setInterval(function () {
        manageBrand(1);
    },500);
    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageBrand(pn);
        clearInterval(brand_auto_load);
    });
    //fetch brand
    fetch_brand();
    function fetch_brand() {
        $.ajax({
            url:"op/process.php",
            method : "POST",
            data : {getBrand:1},
            success : function(data){
                var choose = "<option value=''>Choose Brand</option>";
                $("#select_brand").html(choose+data);
            }
        })
    }
    //DELETE Brand

    $("body").delegate(".del_brand","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure ? You want to delete..!")) {
            $.ajax({
                url : "op/process.php",
                method : "POST",
                data : {deleteBrand:1,id:did},
                success : function(data){
                    if (data == "DELETED") {
                        swal_del_brand();
                        manageBrand(1);
                    }else{
                        alert(data);
                    }
                }
            })
        }
    });

    //Update Brand
    $("body").delegate(".edit_brand","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : "op/process.php",
            method : "POST",
            dataType : "json",
            data : {updateBrand:1,id:eid},
            success : function(data){
                console.log(data);
                $("#bid").val(data["brand_id"]);
                $("#update_brand").val(data["brandname"]);
            }
        })
    });

    $("#update_brand_form").on("submit",function(){
        if ($("#update_brand").val() == "") {
            $("#update_brand").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        }else{
            $.ajax({
                url : "op/process.php",
                method : "POST",
                data  : $("#update_brand_form").serialize(),
                success : function(data){
                    if(data == "UPDATED"){
                        swal_update_brand();
                        $('#brandModal').modal('toggle');
                        //window.location.href = "";
                    }else if(data == 'NOT_UPDATED'){
                        swal_not_update();
                    }
                }
            })
        }
    });
    //fetch_category();
    //------------------------------------------------------------Product--------------------------------------

    //pro check
    function verify_product_name(productname){
        $.ajax({
            url:"op/process.php",
            method:"POST",
            data:{check_product_name:1,productname:productname},
            success: function (data) {
                if(data == "already_exists"){
                    $(this).addClass('border-danger');
                    $('#product_name_error').html("<span class='text-danger'>Already exists !!</span>");
                }else if(data == "ok"){
                    $("#product_name_error").html("<span class='text-success'>Avilable!!</span>");
                }
            }
        })
    }
    $('#productname').blur(function () {
        if($(this).val() == ''){
            $(this).addClass('border-danger');
            $('#product_name_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            $(this).removeClass('border-danger');
            $('#product_name_error').html("");
            var productname = $(this).val();
            verify_product_name(productname);
        }
    });


    $('#add_product_form').on("submit",function () {
        var productname = $('#productname');
        var select_cat = $('#select_cat');
        var select_brand = $('#select_brand');
        var price  = $('#price');
        var quantity  = $('#quantity');
        var keywords  = $('#keywords');
        var status = false;

        if(productname.val() == ''){
            productname.addClass('border-danger');
            $('#product_name_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            productname.removeClass('border-danger');
            $('#product_name_error').html('');
            status = true;
        }
        if(select_cat.val() == ''){
            select_cat.addClass('border-danger');
            $('#product_cat_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            select_cat.removeClass('border-danger');
            $('#product_cat_error').html('');
            status = true;
        }
        if(select_brand.val() == ''){
            select_brand.addClass('border-danger');
            $('#product_brand_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            select_brand.removeClass('border-danger');
            $('#product_brand_error').html('');
            status = true;
        }
        if(price.val() == ''){
            price.addClass('border-danger');
            $('#product_price_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            price.removeClass('border-danger');
            $('#product_price_error').html('');
            status = true;
        }
        if(quantity.val() == ''){
            quantity.addClass('border-danger');
            $('#product_quantity_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            quantity.removeClass('border-danger');
            $('#product_quantity_error').html('');
            status = true;
        }
        if(keywords.val() == ''){
            keywords.addClass('border-danger');
            $('#product_keywords_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            keywords.removeClass('border-danger');
            $('#product_keywords_error').html('');
            status = true;
        }
        var fdata = new FormData(this);
        if (status == true && productname.val() != "" &&  select_cat.val() != "" && select_brand.val() != "") {
            $.ajax({
                url:"op/process.php",
                method : "POST",
                data:fdata,
                cache:false,
                processData:false,
                contentType:false,
                // data : $("#add_product_form").serialize(),
                success : function(data){
                    if(data == 'already_exists'){
                        //alert('Product Already Added!');
                        swal_product_exists();
                    }else if(data == 'EXT_NOT_MATCH'){
                        //alert('Extension Should be png , jpg, jpeg');
                        swal__product_ext_not_match();
                    }else if(data == 'PRODUCT_INSERTED'){
                        swal_add_product();
                        //  alert('Product Added Successfully!');
                    }else if(data == 'PRODUCT_NOT_INSERTED'){
                        //alert('Product Not Add!');
                        swal_product_not_add();
                    }
                }
            })
        }else{
            //alert("some thing error");
            swal_something_wrong();
        }
    });
    var product_auto_load = setInterval(function () {
        manageProduct(1);
    },800);
    manageProduct(1);
    function manageProduct(pn){
        $.ajax({
            url:"op/process.php",
            method : "POST",
            data : {manageProduct:1,pageno:pn},
            success : function(data){
                $("#get_product").html(data);
            }
        })
    };

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageProduct(pn);
        clearInterval(product_auto_load);
    });


//DELETE Product
    $("body").delegate(".del_product","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure ? You want to delete..!")) {
            $.ajax({
                url:"op/process.php",
                method : "POST",
                data : {deleteProduct:1,id:did},
                success : function(data){
                    if (data == "DELETED") {
                        swal_delete_product();
                        manageProduct(1);
                    }else{
                        alert(data);
                    }
                }
            })
        }
    });

    $("body").delegate(".view_product","click",function(){
        var id = $(this).attr("vid");
        $.ajax({
            url:"op/process.php",
            method : "POST",
            dataType : "json",
            data : {single_product:1,id:id},
            success : function(data){
                $("#Sproductname").text(data['productname']);
                $("#category").text(data["catname"]);
                $("#brand").text(data["brandname"]);
                $("#price").text("$ " + data["price"]);
                $("#quantity").text(data["quantity"]);
                $("#keywords").text(data["keywords"]);
                if(data["status"] == 0){
                    $("#status").html("<a class='btn btn-success text-light btn-sm'>Active</a>");
                }else{
                    $("#status").html("<a class='btn btn-danger text-light btn-sm'>Inctive</a>");
                }

                if(data["type"] == 0){
                    $("#type").html("<a class='btn btn-warning text-light btn-sm'>F</a>");
                }else if(data["type"] == 1){
                    $("#type").html("<a class='btn btn-success text-light btn-sm'>N</a>");
                }
                else {
                    $("#type").html("<a class='btn btn-info text-light btn-sm'>T</a>");
                }
                $("#image").html("<img src='uploads/products/"+ data['image'] +"' alt='' width='60%'>");
                $("#date").text(data["add_date"]);
                $("#description").text(data["description"]);
            }
        })
    });

    //Update Product
    $("body").delegate(".edit_product","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url:"op/process.php",
            method : "POST",
            dataType : "json",
            data : {updateProduct:1,id:eid},
            success : function(data){
                console.log(data);
                $("#pid").val(data["product_id"]);
                $("#up_productname").val(data["productname"]);
                $("#u_cat").val(data["cat_id"]);
                $("#select_brand").val(data["brand_id"]);
                $("#up_price").val(data["price"]);
                $("#up_productquantity").val(data["quantity"]);
                $("#up_keywords").val(data["keywords"]);
                $("#up_status").val(data["status"]);
                $("#up_description").val(data["description"]);
                $("#image_S").html("<img src='uploads/products/"+ data['image'] +"' alt='' width='80px'>");

            }
        })
    });
    $("#update_product_form").on("submit",function(){
        var img =  $("#up_image").val();
        if(img == ''){
            $.ajax({
                url : "op/process.php",
                method : "POST",
                data : $("#update_product_form").serialize(),
                success : function(data){
                    if (data == "UPDATED") {
                        $('#productModal_update').modal('toggle');
                        swal_up_product();
                       // window.location.href = "";
                        //location.reload(5000);

                    }else{
                        alert(data);
                    }
                }
            })
        }else{
            var fdata = new FormData(this);
            $.ajax({
                url:"op/process.php",
                method : "POST",
                data:fdata,
                cache:false,
                processData:false,
                contentType:false,
                // data : $("#add_product_form").serialize(),
                success : function(data){
                    if(data == 'already_exists'){
                        //alert('Product Already Added!');
                        swal_product_exists();
                    }else if(data == 'EXT_NOT_MATCH'){
                        //alert('Extension Should be png , jpg, jpeg');
                        swal__product_ext_not_match();
                    }else if(data == 'UPDATED'){
                        swal_up_product();
                        $('#productModal_update').modal('toggle');
                        //  alert('Product Added Successfully!');
                    }else if(data == 'PRODUCT_NOT_INSERTED'){
                        //alert('Product Not Add!');
                        swal_product_not_add();
                    }
                }
            })
        }
    });

    $("body").delegate(".active-s","click",function(e) {
        e.preventDefault();
        var pid = $(this).attr("pid");
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {change_status_make_inactive:1,pid:pid},
            success : function(data){
                if (data == "UPDATED") {
                    success("Updated!");
                }else{
                    alert(data);
                }
            }
        })
    });

    $("body").delegate(".inactive-s","click",function(e) {
        e.preventDefault();
        var pid = $(this).attr("pid");
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {change_status_make_active:1,pid:pid},
            success : function(data){
                if (data == "UPDATED") {
                    success("Updated!");
                }else{
                    alert(data);
                }
            }
        })
    })
    //-----------------------------------Manage Order----------------------------
    var newOrder_autoload_Badge = setInterval(function () {
        countNewOrder();
        countShiftOrder()
    },500);
    var newOrder_autoload = setInterval(function () {
        get_newOrders(1);
    },800);
    countNewOrder();
    function countNewOrder() {
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {countNewOrder:1},
            success : function(data){
               $('#newOrder').text(data);
            }
        })
    };
    countTotalProducts();
    function countTotalProducts() {
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {countTotalProducts:1},
            success : function(data){
                $('#totalProducts').text(data);
            }
        })
    };
    countShiftOrder();
    function countShiftOrder() {
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {countShiftOrder:1},
            success : function(data){
                $('#shiftOrder').text(data);
            }
        })
    };

    get_newOrders(1);
    function get_newOrders(pn) {
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {get_newOrders:1,pageno:pn},
            success : function(data){
                $('#get_new_order').html(data);
            }
        })
    }
    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        get_newOrders(pn);
        clearInterval(newOrder_autoload);
    });
//shift order
    $("body").delegate(".shift-order","click",function(e){
        e.preventDefault();
        var oid = $(this).attr("oid");
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {shift_order:1,oid:oid},
            success : function(data){
               success("Order Shifted Successfully!");
                get_newOrders(1);
                countNewOrder();
            }
        })
    });

    get_shiftOrders(1);
    function get_shiftOrders(pn) {
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {get_shiftOrder:1,pageno:pn},
            success : function(data){
                $('#get_shift_order').html(data);
            }
        })
    }
    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        get_shiftOrders(pn);
    });

    //delivery
    $("body").delegate(".shift-delivery","click",function(e){
        e.preventDefault();
        var oid = $(this).attr("oid");
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {shift_delivery:1,oid:oid},
            success : function(data){
                success("Order Delivery Successfully!");
                get_shiftOrders(1);
                countShiftOrder();
            }
        })
    });
    get_deliveryOrders(1);
    function get_deliveryOrders(pn) {
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {get_deliveryOrder:1,pageno:pn},
            success : function(data){
                $('#get_delivery_order').html(data);
            }
        })
    }
    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        get_deliveryOrders(pn);
    });
    $("body").delegate(".make-rece","click",function(){
        var oid = $(this).attr("oid");
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {make_trush_delivery:1,oid:oid},
            success : function(data){
                success("Complete!");
                get_shiftOrders(1);
                countShiftOrder();
                get_deliveryOrders(1)
            }
        })
    });
    $("body").delegate(".view_customer","click",function() {
        var cid = $(this).attr("vid");
        $.ajax({
            url: "op/process.php",
            method: "POST",
            dataType: "json",
            data: {getCusDetails: 1, cid: cid},
            success: function (data) {
                $('#cusName').text(data['cus_fname']+" " + data['cus_lname']);
                $('#cusEmail').text(data['email']);
                $('#cusPhone').text(data['cus_phone']);
                $('#cusAdd1').text(data['cus_address']);
                $('#cusAdd2').text(data['cus_address_2']);
                $('#cusCity').text(data['cus_city']);
                $('#cusPcode').text(data['cus_zip']);
            }
        })
    });
    //  ``, `cus_lname`, `cus_uname`, ``, `cus_pass`, ``, ``, ``, ``, `cus_zip`, `total_order`, `add_date
    //------------------------------------------SWAL--------------------------
    function success(s) {
        swal("Success!", s, "success");
    }
    function swal_something_wrong() {
        swal("Error : )", "Something Wrong", "info");
    }
    function swal_not_update(){
        swal("Not Update!", "You clicked the button!", "error");
    }
    function swal_add_brand(){
        swal("Successfully Added!", "You clicked the button!", "success");
    }
    function swal_update_brand(){
        swal("Succesfully Updated!", "You clicked the button!", "success");
    }
    function swal_del_brand(){
        swal("Succesfully Delete!", "You clicked the button!", "success");
    }
    function swal_delete_cat(){
        swal("Successfully Delete!", "You clicked the button!", "success");
    }
    function swal_update_cat(){
        swal("Successfully Update!", "You clicked the button!", "success");
    }
    function swal_add_cat(){
        swal("Succesfully Added!", "You clicked the button!", "success");
    }
    function swal_not_delete_cat_parent(){
        swal("Sorry !", "This Category is dependent on other sub categories!", "error");
    }
    function swal_add_product(){
        swal("Succesfully Added!", "You clicked the button!", "success");
    }
    function swal__product_ext_not_match() {
        swal("Error", "Extension Should be png , jpg, jpeg", "error");
    }
    function swal_product_not_add() {
        swal("Error", "Product Not Add : )", "error");
    }
    function swal_product_exists() {
        swal("Error", "Product Already Added : )", "error");
    }
    function swal_delete_product(){
        swal("Successfully Delete!", "You clicked the button!", "success");
    }
    function swal_up_product(){
        swal("Succesfully Update!", "You clicked the button!", "success");
    }
    function swal_not_up_product(){
        swal("Not Update!", "You clicked the button!", "error");
    }
})