$(document).ready(function () {
  var limit = 2;
  $("#load_more").click(function (e) {
    e.preventDefault();
    limit += 2;
    $("#blog_section").load("fetch.php", {
      limit: limit
    });
  });
  $("#show_less").click(function (e) {
    e.preventDefault();
    limit -= 2;
    $("#blog_section").load("fetch.php", {
      limit: limit
    });
  });
});