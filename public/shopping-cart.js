
if(localStorage.getItem('shoppingCart') == null) {
    localStorage.setItem('shoppingCart', JSON.stringify({
        date: Date.now(),
        products: []
    }))
}

function addShoppingCart (name, price, color, size, picUrl) {
    let shoppingCart = JSON.parse(localStorage.getItem('shoppingCart'));
    shoppingCart.products.push({
        id: Math.random().toString(16).slice(2),
        name: name,
        price: price,
        color: color,
        size: size,
        picUrl: picUrl
    });
    localStorage.setItem('shoppingCart', JSON.stringify(shoppingCart));
    document.getElementById('shoppingCartItemCount').innerText = shoppingCart.products.length;
}

let shoppingCart = JSON.parse(localStorage.getItem('shoppingCart'));
document.getElementById('shoppingCartItemCount').innerText = shoppingCart.products.length;

window.addShoppingCart = addShoppingCart;
