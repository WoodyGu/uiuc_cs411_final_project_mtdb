// var button = document.getElementById("searchButton");
// var searchInput = document.getElementById("searchInput");
// function search() {
//   alert("run search");
//   if (searchInput.value.length == 0) {
//     alert("Enter a word or phrase to search on in the form at the top of the page.")
//     return false;
//   }
//   else {
//     alert("what the fuck");
//     return true;
//   }
// }

function require() {
  var empt = document.forms["searchForm"]["search"].value;
  if (empt == "") {
    alert("Enter a word or phrase to search on in the form at the top of the page.");
    return "<?=$_SERVER['PHP_SELF'];?>";
  }
  return "search_result.php";
}
