let container = document.querySelector(".spin-wheel-container");
let btn = document.getElementById("spin");
let prizeElements = document.querySelectorAll(".spin-wheel-item");
let numPrizes = prizeElements.length;
let maxRotation = numPrizes * 360;
let prizeAngle = 360 / numPrizes;

// Apply angles to spin wheel items
let offset = 0;
for (let i = 0; i < numPrizes; i++) {
    prizeElements[i].style.transform = `rotate(${offset}deg)`;
    offset += prizeAngle;
}

btn.onclick = function () {
    let randomDegree = Math.floor(Math.random() * maxRotation + 1);
    container.style.transform = "rotate(" + randomDegree + "deg)";
    // Add code to capture and display the prize information
};

container.addEventListener("transitionend", function () {
    let currentRotation = container.style.transform.replace(/[^0-9\-\.]/g, '');
    let currentDegree = currentRotation % 360;
    let targetDegree = (360 - currentDegree + 90) % 360;
    let targetPrizeIndex = Math.floor(targetDegree / prizeAngle);
    let targetPrizeElement = prizeElements[targetPrizeIndex];
    let prizeId = targetPrizeElement.dataset.prize;
    // Fetch and display the prize information using the prizeId
    // You can use AJAX or server-side logic to retrieve the prize details
});