document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const colors = ["orange", "white", "red"]; // Gradient colors
    let currentColorIndex = 0;

    function changeGradient() {
        body.style.background = `linear-gradient(to right, ${colors[currentColorIndex]}, ${colors[(currentColorIndex + 1) % colors.length]})`;
        currentColorIndex = (currentColorIndex + 1) % colors.length;
    }

    setInterval(changeGradient, 2000); // Change gradient every 2 seconds
});