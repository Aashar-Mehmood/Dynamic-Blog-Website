$(document).ready(function () {
  var allBtns = document.querySelectorAll('aside button');
  allBtns.forEach(btn => {
    $(btn).click(function (e) {
      e.preventDefault();
      var targetId = e.target.id;
      $("#blog_section").load("fullBlog.php", { blogId: targetId });
      document.body.scrollIntoView(20);
    });
  });
});