const form = document.querySelector(".c-typing"),
receiving_id = form.querySelector(".c-receiving_id").value,
inputField = form.querySelector(".c-input"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".c-chatbox");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    var request = new XMLHttpRequest();
    request.open("POST", "./insertchat.php", true);
    request.onload = ()=>{
      if(request.readyState === XMLHttpRequest.DONE){
          if(request.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    var formData = new FormData(form);
    request.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    var request = new XMLHttpRequest();
    request.open("POST", "./getchat.php", true);
    request.onload = ()=>{
      if(request.readyState === XMLHttpRequest.DONE){
          if(request.status === 200){
            var data = request.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("receiving_id="+receiving_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  