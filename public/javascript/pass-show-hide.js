const pwd = document.querySelector(".form input[type='password']"),
    toggleIcon = document.querySelector(".form .field i");

toggleIcon.onclick = () => {
    if (pwd.type === "password") {
        pwd.type = "text";
        toggleIcon.classList.add("active");
    } else {
        pwd.type = "password";
        toggleIcon.classList.remove("active");
    }
}
