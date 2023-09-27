
// Sidebar
var hamburger = document.querySelector("#hamburger");

	hamburger.addEventListener("click", function () {
	document.querySelector("#sidebar").classList.toggle("active");
	document.querySelector("#hamburger").classList.toggle("active");
	document.querySelector(".content").classList.toggle("active-blur");
	document.querySelector("#shopping-cart").classList.toggle("active");
})

document.onclick = function (e) {
	if (e.target.id !== 'sidebar' && e.target.id !== 'hamburger') {
		
		document.querySelector("#sidebar").classList.remove("active");
		document.querySelector("#hamburger").classList.remove("active");
		document.querySelector(".content").classList.remove("active-blur");  
		document.querySelector("#shopping-cart").classList.remove("active");
	}
}
