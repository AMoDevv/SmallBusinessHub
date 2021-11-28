$(document).ready(() => {
  $(".like_button").on("click", clk);

  function clk(e) {
    console.log(e.target.attributes["value"].value);
    console.log(e.target.attributes["value-liked"].value);
    post_id = e.target.attributes["value"].value;

    $.ajax({
      type: "POST",
      url: "./phpscripts/save.php",
      data: {
        post_id: post_id,
        liked: e.target.attributes["value-liked"].value,
      },
    }).done(function (msg) {
      $.get(
        "./view.php",
        {
          id: post_id,
        }, (msg, stat, err) => {
          $(".modal-change").html(msg)
          $(".like_button").on("click", clk);
        })
    });
        
  }
});
