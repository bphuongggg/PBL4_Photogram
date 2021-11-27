const inputSearch = document.querySelector(".c-new input"),
searchBtn = document.querySelector(".c-new button"),
userList = document.querySelector(".c-userlist");

searchBtn.onclick = ()=>{
  inputSearch.classList.toggle("show");
  searchBtn.classList.toggle("active");
  inputSearch.focus();
  if(inputSearch.classList.contains("active")){
    inputSearch.value = "";
    inputSearch.classList.remove("active");
  }
}

inputSearch.onkeyup = ()=>{
  var searchTerm = inputSearch.value;
  if(searchTerm != ""){
    inputSearch.classList.add("active");
  }else{
    inputSearch.classList.remove("active");
  }
  var request = new XMLHttpRequest();
  request.open("POST", "./search.php", true);
  request.onload = ()=>{
    if(request.readyState === XMLHttpRequest.DONE){
        if(request.status === 200){
          var data = request.response;
          userList.innerHTML = data;
        }
    }
  }
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("searchTerm=" + searchTerm);
}

setInterval(() =>{
  var request = new XMLHttpRequest();
  request.open("GET", "./users.php", true);
  request.onload = ()=>{
    if(request.readyState === XMLHttpRequest.DONE){
        if(request.status === 200){
          var data = request.response;
          if(!inputSearch.classList.contains("active")){
            userList.innerHTML = data;
          }
        }
    }
  }
  request.send();
}, 500);

