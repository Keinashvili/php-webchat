const search = document.getElementById("search"),
searchbtn = document.getElementById("search-btn");

searchbtn.onclick = () =>{
    search.classList.toggle("active");
    search.focus();
    searchbtn.classList.toggle("active");
}