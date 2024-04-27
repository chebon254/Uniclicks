let container = document.querySelector(".spin-wheel-container");
let btn = document.getElementById("spin");
let number = Math.ceil(Math.random() * 8000);

btn.onclick = function () {
	container.style.transform = "rotate(" + number + "deg)";
	number += Math.ceil(Math.random() * 8000);
}