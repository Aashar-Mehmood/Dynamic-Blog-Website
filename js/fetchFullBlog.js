$(document).ready(function () {
  const allBtns = document.querySelectorAll('aside button');
  allBtns.forEach(btn => {
    $(btn).click(function (e) {
      e.preventDefault();
      var targetId = e.target.id;
      console.log(targetId);
      $("#blog_section").load("fullBlog.php", { blogId: targetId });
    });
  });
});