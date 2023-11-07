
function loadClouds () {

    const screenWidth = window.innerWidth;
    const countClouds = Math.round(screenWidth / 300);

    for(let i = countClouds; i >= 0; i--) {
        const cloud = document.createElement("img");
        cloud.src = "cloud.png";
        cloud.draggable = false;
        cloud.style.transform = "translateY(" + Math.floor(Math.random() * window.innerHeight) + "px)";
        let delay = 30 / (countClouds + 1) * i;
        console.log(i)
        cloud.style.animationDelay = delay + "s";
        document.getElementById('bg').appendChild(cloud);
    }

}

window.loadClouds = loadClouds;

loadClouds();

if(document.getElementById('shoppingCartLink') !== null) {
    let shoppingCart = JSON.parse(localStorage.getItem("shopping-cart"));
    document.getElementById('shoppingCartLink').innerText = "Shopping Cart (" + shoppingCart.length + ")";
}