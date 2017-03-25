// 這裡可以先不要看，只是特效而已
$("#post_input").hide(); // 預設隱藏
$("#cancel").hide();     // 預設隱藏

$("#post").click(function(){
    $("#post_input").fadeIn(); // 點擊後顯示表單
    $("#cancel").show(); // 點擊後顯示取消按鈕
    $("#post").hide();
});

$("#cancel").click(function(){
    $("#post_input").hide(); // 點擊後顯示表單
    $("#cancel").hide(); // 點擊後顯示取消按鈕
    $("#post").fadeIn();
});
