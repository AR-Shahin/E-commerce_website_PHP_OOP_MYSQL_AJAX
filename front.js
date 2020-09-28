$(document).ready(function () {
    $('#slider_c').hide();
    fetch_category_front();
    function fetch_category_front(){
        $.ajax({
            url:"admin/op/process.php",
            method : "POST",
            data : {getCategory_front:1},
            success : function(data){
                $("#front_categories").html(data);
            }
        })
    };
    manageProduct(1);
    function manageProduct(pn){
        $.ajax({
            url:"admin/op/process.php",
            method : "POST",
            cache:false,
            data : {front_product:1,pageno:pn},
            success : function(data){

                $("#front_product_top").html(data);
            }
        })
    };
    //-----------------------------------------------------------------



    shop_Page_Product(1);
    function shop_Page_Product(pn){
        $.ajax({
            url:"admin/op/process.php",
            method : "POST",
            cache:false,
            data : {shop_Page_Product:1,pageno:pn},
            success : function(data){

                $("#shop_page_product").html(data);
            }
        })
    };
    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        shop_Page_Product(pn);
    });

    //-------------------------------------------------------------------
    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageProduct(pn);
    });
    $("body").delegate(".categories","click",function(e){
        e.preventDefault();
        var cid = $(this).attr("fcid");
        $('#slider').hide();
        $('#slider_c').show();
        $.ajax({
            url:"admin/op/process.php",
            method : "POST",
            cache:false,
            data : {category_wise_product:1,cat_id:cid},
            success : function(data){
                $("#category_wise_product").html(data);
            }
        })
    });

    function random_suggest_product() {
        $.ajax({
            url:"admin/op/process.php",
            method : "POST",
            cache:false,
            data : {random_suggest_product:1},
            success : function(data){
                $('#recomand_iteams_front').html(data);
            }
        })
    }
    random_suggest_product();
//----------------------------------------------CUSTOMER FORM ---------------------------------------
    //username check
    function verify_username(name) {
        $.ajax({
            url:"admin/op/action.php",
            method:"POST",
            data:{check_username:1,username:name},
            success: function (data) {
                $('#u_error').html(data);
            }
        })
    }
    $('#uname').blur(function () {
        if($(this).val() == ''){
            $(this).addClass('border-danger');
            $('#u_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            $(this).removeClass('border-danger');
            $('#u_error').html("");
            var username = $(this).val();
            verify_username(username);
        }
    });


    $('#cus_reg_form').on("submit",function () {

        var fname = $('#fname');
        var lname = $('#lname');
        var uname = $('#uname');
        var email = $('#email');
        var phone = $('#phone');
        var address = $('#address');
        var pass1  = $('#pass1');
        var pass2 = $('#pass2');
        var status = false;
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
        if(fname.val() == ''){
            fname.addClass('border-danger');
            $('#f_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            fname.removeClass('border-danger');
            $('#f_error').html('');
            status = true;
        }
        if(lname.val() == ''){
            lname.addClass('border-danger');
            $('#l_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            lname.removeClass('border-danger');
            $('#l_error').html('');
            status = true;
        }
        if(uname.val() == ''){
            uname.addClass('border-danger');
            $('#u_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            uname.removeClass('border-danger');
            $('#u_error').html('');
            status = true;
        }
        if(phone.val() == ''){
            phone.addClass('border-danger');
            $('#p_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            phone.removeClass('border-danger');
            $('#p_error').html('');
            status = true;
        }
        if(address.val() == ''){
            address.addClass('border-danger');
            $('#add_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            address.removeClass('border-danger');
            $('#add_error').html('');
            status = true;
        }
        if(email.val() == ''){
            email.addClass('border-danger');
            $('#e_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            if (!e_patt.test(email.val())) {
                email.addClass('border-danger');
                $('#e_error').html("<span class='text-danger'>Please enter valid email!!</span>");
            } else {
                email.removeClass('border-danger');
                $('#e_error').html('');
                status = true;
            }
        }

        if(pass1.val() == "" || pass1.val().length < 6){
            pass1.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Please Enter more than 6 digit password</span>");
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
                url:"admin/op/action.php",
                method : "POST",
                data : $("#cus_reg_form").serialize(),
                success : function(data){
                    if(data == 'INSERTED_USER'){
                        window.location.href = "signin.php?success_mgs=You are registered Now you can login ";
                    }else {
                        swal_something_wrong();
                    }
                }

            })
        }else{
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Password not Match!!!</span>");
            status = false;
        }
    });


    $('#cus_log_form').on("submit",function () {
        var uname = $('#cus_uname');
        var pass = $('#cus_pass');
        var status = false;

        if(uname.val() == ""){
            uname.addClass("border-danger");
            $("#log_cus_u_error").html("<span class='text-danger'>Field must not be empty!!</span>");
            status = false;
        }else{
            uname.removeClass("border-danger");
            $("#log_cus_u_error").html("");
            status = true;
        }

        if(pass.val() == ""){
            pass.addClass("border-danger");
            $("#log_cus_p_error").html("<span class='text-danger'>Field must not be empty!!</span>");
            status = false;
        }else{
            pass.removeClass("border-danger");
            $("#log_cus_p_error").html("");
            status = true;
        }

        if(status){
            $(".overlay").show();
            $.ajax({
                url:"admin/op/action.php",
                method : "POST",
                data : $("#cus_log_form").serialize(),
                success : function(data){
                    if(data == "invalid_email"){
                        uname.addClass('border-danger');
                        $('#log_cus_u_error').html("<span class='text-danger'>Invalid Email!!</span>");
                    }else if(data == "NOT_REGISTER"){
                        uname.addClass('border-danger');
                        $('#log_cus_u_error').html("<span class='text-danger'>It seems like you are not registered !!</span>");
                    }else if(data == 'PASSWORD_NOT_MATCH') {
                        pass.addClass('border-danger');
                        $('#log_cus_p_error').html("<span class='text-danger'>Password Not Match!</span>");
                    }else if(data == 'SUCCESS_LOGIN'){
                        window.location.href ="index.php";
                    }
                }

            })
        }
    });
    //search_content
    $('#search_btn').keyup(function () {
        var skill = $(this).val()
        if(skill != ''){
            $.ajax({
                url:"admin/op/action.php",
                method : "POST",
                data :{skill:skill},
                success:function (data) {
                    $('#suggestTxt').fadeIn();
                    $('#suggestTxt').html(data);
                }
            })
        }else{
            $('#suggestTxt').fadeOut();
        }
    });
    $('#suggestTxt').hide();
    $(document).on('click','li',function () {
        $('#search_btn').val($(this).text());
        $('#suggestTxt').fadeOut();
    });

    $('#search_by_key').click(function () {
        var key = $('#search_btn').val();
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            cache:false,
            data : {search_suggest_product:1,key:key},
            success : function(data){
                $('#slider_category').fadeOut();
                $('#search_content').html(data);
                $('#suggestTxt').fadeOut();
            }
        })
    });
// alert
    $('#shahin').hide();
    setTimeout(function(){
        $('#shahin').fadeIn();
    }, 5000);

    $("body").delegate("#add_to_cart","click",function(e){
        e.preventDefault();
        var pid = $(this).attr('fpid');
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {add_to_cart:1,pid:pid},
            success : function(data){
                if(data == 'EXISTS'){
                    swal_product_already_added();
                }else if(data == 'PRODUCT_ADD_CART'){
                    swal_product_added_success();
                    get_cat_item();
                    count_cat_item();
                }
                else if(data == 'PLZ_LOGIN'){
                    info("Please Login First.....");
                }
                else if(data == 'PRODUCT_NOT_ADD_CART'){
                    swal_product_not_add_to_cart();
                }
                else {
                    alert(data);
                }
            }
        })
    });
//--------------------------------------CART
    count_cat_item();
    function count_cat_item() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {count_cart_item:1},
            success : function(data){
                $('.badge').text(data);
            }
        })
    }
    get_cat_item();
    function get_cat_item() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {get_cart_item:1},
            success : function(data){
                if(data == null){
                    $('#nullll').text("nnn");
                }
                $('#cart_items').html(data);
            }
        })
    }
    get_checkout_item();
    function get_checkout_item() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {get_checkout_items:1},
            success : function(data){
                $('#cart_checkout').html(data);
            }
        })
    }
    $("body").delegate(".qty","keyup",function(e){
        e.preventDefault();
        var pid = $(this).attr("pid");
        var quty = $('#qty-'+ pid).val();
        var price = $('#price-'+ pid).val();
        var avl = $('#avl-'+ pid).val();
        if(isNaN($(this).val())){
            error("Please enter a valid Quantity");
            //alert("Please enter a valid Quantity");
            $(this).val(1);
            var total = $(this).val() * price;
            $('#total-' + pid).val(total);
        }else {
            if (($(this).val() -0 ) > avl) {
                error("Sorry ! This much of quantity is not available");
                $(this).val(1);
                var total = $(this).val() * price;
                $('#total-' + pid).val(total);
            }else if(($(this).val() *1 ) < 0){
                error("Sorry ! You Entered Negative value!");
                $(this).val(1);
                var total = $(this).val() * price;
                $('#total-' + pid).val(total);
            } else {
                var total = $(this).val() * price;
                $('#total-' + pid).val(total);
            }
        }
    });

    $('body').delegate(".remove","click",function (e) {
        e.preventDefault();
        var pid = $(this).attr('rmv_id');

        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {delete_checkout_items:1,pid:pid},
            success : function(data){
                if(data == 'DELETED'){
                    success("Successfully Delete Cart Item...");
                    get_checkout_item();
                    count_cat_item();
                    calculate();
                }else if(data == 'NOT_DELETE'){
                    error("Not Delete Cart Item...");
                    calculate();
                    count_cat_item();
                }
            }
        })

    })
//update cart
    $('body').delegate(".update","click",function (e) {
        e.preventDefault();
        var pid = $(this).attr('up_id');
        var qty = $('#qty-'+ pid).val();
        var price = $('#price-'+ pid).val();
        var total = $('#total-'+ pid).val();
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {update_checkout_items:1,pid:pid,qty:qty,total:total,price:price},
            success : function(data){
                if(data == 'UPDATED'){
                    success("Successfully Update Cart Item...");
                    get_checkout_item();
                    calculate();
                }else if(data == 'NOT_UPDATED'){
                    error("Not Update  Cart Item...");
                    calculate();
                }
            }
        })

    });
    calculate();
    function calculate() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {calculate_price:1},
            success : function(data){
                /*    $('#subtotal').text(data);
                 $('#shiping').text(20);
                 var sub = data * 1;
                 var sp = 20;
                 var tx = Math.floor(sub * 0.1);
                 $('#tax').text(tx);
                 var total_sum = (sub + sp + tx) * 1;*/
                $('#total_sum').text(data);
            }
        })
    };

    //------------------------------ORDER----------------------
    get_customer_data();
    function get_customer_data() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            dataType : "json",
            data : {get_customer_data:1},
            success : function(data){
                $('#firstname').val(data['cus_fname']);
                $('#lastname').val(data['cus_lname']);
                $('#email2').val(data['email']);
                $('#telephone').val(data['cus_phone']);
                $('#address1').val(data['cus_address']);
                $('#address2').val(data['cus_address_2']);
                $('#city').val(data['cus_city']);
                $('#postcode').val(data['cus_zip']);

            }
        })
    };

    $('#cus_bill_form').on("submit",function () {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : $("#cus_bill_form").serialize(),
            success : function(data){
                if(data == 'UPDATED'){
                    success(" Billing Information Accepted !");
                }else if(data == 'NOT_UPDATED'){
                    error(" Something is Wrong!");
                }
            }
        })
    });

    checkout_item();
    function checkout_item() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {checkout_items:1},
            success : function(data){
                $('#checkout_iteams').html(data);
            }
        })
    };

    $('#confirm_order').click(function (e) {
        e.preventDefault();
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {confirm_order:1},
            success : function(data){
                count_cat_item();
                window.location.href="confirm-order.php";
            }
        })
    });
    get_order_product();
    function get_order_product() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {get_order_product:1},
            success : function(data){
                $('#oder_product').html(data);
            }
        })
    }

    $('body').delegate("#del_oder_product","click",function (e) {
        e.preventDefault();
        var pid = $(this).attr('pid');
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {delete_user_order_product:1,pid:pid},
            success : function(data){
                if(data == 'UPDATED'){
                    success("Deleted From Your Order Page .");
                    get_order_product();
                }
            }
        })
    });

    get_special_product();
    function get_special_product() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {get_special_product:1},
            success : function(data){
                $('#special_products').html(data);
            }
        })
    }

    get_feature_product();
    function get_feature_product() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {get_fet_product:1},
            success : function(data){
                $('#feature_product').html(data);
            }
        })
    }
    get_f_product();
    function get_f_product() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {get_fet_product:1},
            success : function(data){
                $('#f_product').html(data);
            }
        })
    }
    get_top_product();
    function get_top_product() {
        $.ajax({
            url:"admin/op/action.php",
            method : "POST",
            data : {get_top_product:1},
            success : function(data){
                $('#top_f_products').html(data);
            }
        })
    }

    countCommentNumber();
    function countCommentNumber() {
        $.ajax({
            url : "op/process.php",
            method : "POST",
            data : {countCommentNumber:1},
            success : function(data){
                $('#commentNumber').text(data);
            }
        })
    };

//comment
    $('#commentform').on("submit",function () {
        $.ajax({
            url : "admin/op/action.php",
            method : "POST",
            data : $('#commentform').serialize(),
            success : function(data){
                if(data == 'FIELD_EMPTY'){
                    info("Field Must not be Empty!");
                }else if(data == 'INSERT'){
                    success("Thanks for Comment.");
                    countCommentNumber();
                }else if(data == 'NOT_INSERT'){
                    error("Something is Wrong!")
                }
            }
        })
    });

    var cat_auto_load = setInterval(function () {

    },500);
    //-----------------------------------------------SWAL..
    function test(a) {
        swal("Test", a, "info");
    }
    function success(s) {
        swal("Success!", s, "success");
    }
    function error(er) {
        swal("Error : )", er, "error");
    }
    function info(er) {
        swal("Warning! : )", er, "info");
    }
    function swal_something_wrong() {
        swal("Error : )", "Something is Wrong.....", "error");
    }
    function swal_product_already_added() {
        swal("Error : )", "Product Already Added.....", "info");
    }
    function swal_product_added_success() {
        swal("Success!", "Successfully Added to Cart!!", "success");
    }
    function swal_product_not_add_to_cart() {
        swal("Error!", "Product Not Add in Cart!!", "error");
    }
})