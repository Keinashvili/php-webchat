const pwd = document.getElementById("pwd"),
btn = document.getElementById("eye");

btn.onclick = () =>{
     if(pwd.type == "password"){
        pwd.type = "text";   
        btn.classList.add("active");
    } else{
        pwd.type = "password";
        btn.classList.remove("active");
    }
}