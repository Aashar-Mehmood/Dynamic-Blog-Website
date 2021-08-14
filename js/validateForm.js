$(document).ready(function () {
  $("#addUser").click(function (e) {
    e.preventDefault();
    var name = $("#userName").val();
    var email = $("#userEmail").val();
    var pwd = $("#pwd").val();
    var pwd2 = $("#pwd2").val();
    $("#message").load("validateForm.php", {
      Name: name,
      Email: email,
      Pwd: pwd,
      Pwd2: pwd2
    });
  });
})