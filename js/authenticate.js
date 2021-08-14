$(document).ready(function () {
  $("#login").click(function (e) {
    e.preventDefault();
    var name = $("#userName").val();
    var email = $("#userEmail").val();
    var pwd = $("#pwd").val();
    $("#message").load("authenticate.php", {
      Name: name,
      Email: email,
      Pwd: pwd
    });
  });
})