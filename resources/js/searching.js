 function searchingEmployee() {
        // Declare variables
        var input, ul, li, a, i, txtValue;
        input = document.getElementById("searching2").value.toUpperCase();
        
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          txtValue = a.text || a.innerText;
          if (txtValue.toUpperCase().indexOf(input) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
      }
      
    
    function searchingTwo() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("searching2");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

