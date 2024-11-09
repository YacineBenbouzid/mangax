function myFunction(x) {
    let list = document.getElementsByClassName('navlist');
    if (list[0].style.display === 'flex') {
        list[0].style.display = 'none';  
        document.body.style.overflow = 'auto'; 
    } else {
        list[0].style.display = 'flex';
        document.body.style.overflow = 'hidden'; 
    }
    x.classList.toggle("change");
}
