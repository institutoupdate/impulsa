function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

(function ($) {
  function debounce(func, wait, immediate) {
    var timeout;
    return function () {
      var context = this,
        args = arguments;
      var later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  }

  var _fetch = debounce(function (node) {
    var val = node.val();
    if (val.length && val.length > 3) {
      $("#datafetch").slideDown();
      $.ajax({
        type: "POST",
        url: config.ajax_url,
        data: { action: "data_fetch", s: val },
        success: function (data) {
          $("#datafetch").html(data);
        },
      });
    } else {
      $("#datafetch").slideUp();
    }
  }, 300);

  window.fetch = function () {
    $("body").on("input", "#keyword", function () {
      _fetch($(this));
    });
  };

  $(document).ready(function () {
    var $container = $("#post-vote");
    var $upvote = $("#post-upvote");
    var $downvote = $("#post-downvote");

    var postID = $container.data("postid");

    try {
      var votes = readCookie("user_votes");
      if (votes) {
        votes = JSON.parse(decodeURIComponent(votes));
        if (votes[postID]) {
          $container.addClass("selected");
          if (votes[postID] == "up") {
            $upvote.addClass("selected");
          } else if (votes[postID] == "down") {
            $downvote.addClass("selected");
          }
        }
      }
    } catch (err) {}

    $upvote.on("click", function (ev) {
      ev.preventDefault();
      $.ajax({
        type: "POST",
        url: config.ajax_url,
        data: { action: "post_upvote", post_id: postID },
        success: function (data) {
          console.log(data);
          if (data.removed) {
            $container.removeClass("selected");
            $upvote.removeClass("selected");
          } else {
            $container.addClass("selected");
            $upvote.addClass("selected");
            $downvote.removeClass("selected");
          }
          if (!isNaN(data.total)) {
            $upvote.find(".count").text(data.total);
          }
        },
      });
    });

    $downvote.on("click", function (ev) {
      ev.preventDefault();
      $.ajax({
        type: "POST",
        url: config.ajax_url,
        data: { action: "post_downvote", post_id: postID },
        success: function (data) {
          if (data.removed) {
            $container.removeClass("selected");
            $downvote.removeClass("selected");
          } else {
            $container.addClass("selected");
            $downvote.addClass("selected");
            $upvote.removeClass("selected");
          }
          if (!isNaN(data.total)) {
            $downvote.find(".count").text(data.total);
          }
        },
      });
    });
  });
})(jQuery);
