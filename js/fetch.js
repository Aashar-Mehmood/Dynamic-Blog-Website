var maxLimit = totalBlogs;
$(document).ready(function () {
  var limit = 2;
  $("#load_more").click(function (e) {
    e.preventDefault();
    if (limit == maxLimit) {
      limit = maxLimit;
    } else {
      limit += 2;
    }
    $("#blog_section").load("fetch.php", {
      limit: limit,
    });
  });
  $("#show_less").click(function (e) {
    e.preventDefault();
    if (limit >= 4) {
      limit -= 2;
    } else {
      limit = 2;
    }
    $("#blog_section").load("fetch.php", {
      limit: limit,
    });
  });
});
