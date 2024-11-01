$(document).ready(function(){
  
$("#bloggy_send").click(function () {
$("div#bloggy_load").toggle()

var bloggy_message = $("#bloggy").val();
$.ajax({
   type: "POST",
   url: "../wp-content/plugins/wordpress-till-bloggy/add.php",
   data: "message=" + bloggy_message + "&update=1" 
 });  
$("p#bloggy_message").fadeIn(700);
$("p#bloggy_message").fadeOut(1000);
$("div#bloggy_load").fadeOut(1500);
$("#bloggy").html("");
    });
 });
