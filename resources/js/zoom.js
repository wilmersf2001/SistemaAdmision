const container = document.querySelector(".zoom-container");
const imageZoom = document.querySelector(".image-zoom");

if (container && imageZoom) {
    container.addEventListener("mousemove", function(event) {
        const containerRect = container.getBoundingClientRect();
        const x = (event.clientX - containerRect.left) / containerRect.width * 100;
        const y = (event.clientY - containerRect.top) / containerRect.height * 100;

        imageZoom.style.transformOrigin = `${x}% ${y}%`;
    });

    container.addEventListener("mouseenter", function() {
        imageZoom.style.transform = "scale(1.5)";
    });

    container.addEventListener("mouseleave", function() {
        imageZoom.style.transform = "scale(1)";
    });
}
