$("#submit").click(function () {
    var _token = $("#_token").val();
    var email = $("#email").val();
    var name = $("#name").val();
    var message = $("#message").val();

    if (email == "" || name == "" || message == "") {
        $('#inf').html('<p style="color:red; font-weight:700">Vui lòng điền đầy đủ thông tin.</p>')
        return false;
    }

    let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (regexEmail.test(email) == false) {
        $('#inf').html('<p style="color:red; font-weight:700">vui lòng nhập đúng định dạng email.</p>')
        return false;
    }

    $.ajax({
        type: "POST",
        url: url + "/gui-lien-he",
        data: {
            email: email,
            name: name,
            message: message,
            _token: _token,
        },
        success: function (data) {
            if (data == "error_empty") {
                $('#inf').html('<p style="color:green; font-weight:700">Vui lòng điền đầy đủ thông tin.</p>').fadeOut(8000)
            } else if (data == "error") {
                alert("Có lỗi trong quá trình gửi liên hệ");
            } else {
                $('#inf').html('<p style="color:green; font-weight:700">Gửi liên hệ thành công! Chúng tôi sẽ trả lời liên hệ của bạn trong thời gian sớm nhất.</p>').fadeOut(8000)
                $("#email").val('')
                $("#message").val('')
                $("#name").val('')
            }
        },
    });
});

$("#btnSendSub").click(function () {
    var txtEmailSub = $("#txtEmailSub").val();
    var _token = $("#_token").val();
    let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (regexEmail.test(txtEmailSub) == false) {
        alert("Email không hợp lệ, vui lòng thử lại");
        return false;
    }

    $.ajax({
        type: "post",
        url: url + "/dang-ky-nhan-tin",
        data: {
            txtEmailSub: txtEmailSub,
            _token: _token,
        },
        success: function (data) {
            if (data == "error_exit_email") {
                alert("Email này đã tồn tại");
            } else if (data == "error") {
                alert("Lỗi trong quá trình thêm email");
            } else {
                alert("Đăng ký email thành công");
                $("#txtEmailSub").val('')
            }
        },
    });
});

$(".addtowishlist").click(function (e) {
    e.preventDefault();

    var post_id = $(".post_id").val();
    var _token = $("#_token").val();

    $.ajax({
        method: "post",
        url: "/tin-yeu-thich",
        data: {
            post_id: post_id,
            _token: _token,
        },
        success: function (data) {
            // console.log(data);
            if (data == "login") {
                alert("Bạn cần đăng nhập để có thể thêm yêu thích");
            } else if (data == "empty") {
                alert("Đã xảy ra lỗi");
            } else {
                alert("Tin đã được thêm vào tin yêu thích");
                location.reload(true);
            }
        },
    });
});

$(".delewl").click(function (e) {
    e.preventDefault();

    var post_id = $(".post_id").val();
    var _token = $("#_token").val();
    // $('#spinner').css({'display':'block'})

    $.ajax({
        method: "post",
        url: "/xoa-tin-yeu-thich",
        data: {
            post_id: post_id,
            _token: _token,
        },
        success: function (data) {
            // console.log(data);
            if (data == "login") {
                alert("Bạn cần đăng nhập để có thể xóa tin yêu thích");
            } else {
                alert("Đã xóa tin yêu thích thành công");
                location.reload(true);
            }
        },
    });
});

$("#k").keyup(function () {
    var query = $(this).val();

    if (query != "") {
        var _token = $("#_token").val();

        $.ajax({
            url: "/autocomplete-ajax",
            method: "POST",
            data: { query: query, _token: _token },
            success: function (data) {
                $("#search_ajax").fadeIn();
                $("#search_ajax").html(data);
            },
        });
    } else {
        $("#search_ajax").fadeOut();
    }
});

$(document).on("click", ".li_search_ajax", function () {
    $("#k").val($(this).text());
    $("#search_ajax").fadeOut;
});

//  bình luận
$(document).ready(function () {

    load_comment();
    
    function load_comment() {
        var IdPost = $("#id_post").val();
        var _token = $("#_token").val();

        $.ajax({
            type: "post",
            url: "/load-binh-luan",
            data: {
                IdPost: IdPost,
                _token: _token,
            },
            success: function (data) {
                $('#loadComment').html(data);     
            },
        });
     
    }
    $("#add_comment").click(function () {
        var txtContent = $("#content").val();
        var txtIdPost = $("#id_post").val();
        var _token = $("#_token").val();

        $.ajax({
            type: "post",
            url: "/them-binh-luan",
            data: {
                id_parent: null,
                txtContent: txtContent,
                txtIdPost: txtIdPost,
                _token: _token,
            },
            success: function (data) {
                if (data == "error_empty") {
                    alert("Không được bỏ trống");
                } else if (data == "error") {
                    alert("Lỗi trong quá trình bình luận");
                } else {
                   $('#noifi').html('<p style="font-weight: 700;color: green;margin-left: 7%;margin-top: 1%;font-size: 19px;">Bình luận thành công</p>').fadeOut(8000)
                   $("#content").val('')
                   load_comment();
                 
                }
            },
        });
    });
    
  
   
});


// function rep_comment(){
    
//         var txtContent = $("#content_rep").val();
//         var txtIdPost = $("#id_post").val();
//         var id_parent = $("#id_comment").val();
//         var _token = $("#_token").val();
    
//         $.ajax({
//             type: "post",
//             url: "/tra-loi-binh-luan",
//             data: {        
//                 txtContent: txtContent,
//                 txtIdPost: txtIdPost,
//                 id_parent: id_parent,
//                 _token: _token,
//             },
//             success: function (data) {
//                 if (data == "reperror_empty") {
//                     alert("Không được bỏ trống");
//                 } else if (data == "reperror") {
//                     alert("Lỗi trong quá trình bình luận");
//                 } else {
//                     alert("Bình luận thành công");
//                     $("#content_rep").val('')
//                     location.reload(true);
//                 }
//             },
//         });
// }


// function activeRepply(id){
    
//     document.getElementById("rep_comment-box_"+id).classList.toggle("rep_comment-box");

//  }