// function jump(num) {
//   window.location.href = "#part2";
// }
//
// var first = document.getElementsByClassName('choice1');
// for (var i = 0; i < first.length; i++) {
//   first[i].addEventListener("click", function() {
//     jump(2);
//   })
// }

var ans1 = "";
var ans2 = "";
var ans3 = "";


for (var i = 1; i < 4; i++) {
  $("#temp" + i).click(function() {
      ans1 = "" + $(this).attr("value");
      $('html, body').animate({
          scrollTop: $("#part" + 2).offset().top
      }, 1000);
  });
}

for (var i = 4; i < 6; i++) {
  $("#temp" + i).click(function() {
    ans2 = "" + $(this).attr("value");
      $('html, body').animate({
          scrollTop: $("#part" + 3).offset().top
      }, 1000);
  });
}

for (var i = 6; i < 12; i++) {
  $("#temp" + i).click(function() {
    ans3 += "" + $(this).attr("value");
      $('html, body').animate({
          scrollTop: $("#part" + 4).offset().top
      }, 1000);
  });
}
