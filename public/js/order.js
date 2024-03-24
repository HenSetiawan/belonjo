const btnPlusQty = document.querySelector("#plus-qty-btn");
const btnMinusQty = document.querySelector("#minus-qty-btn");
const inputQty = document.querySelector("#qty-order");
const maximumStock = document.querySelector("#stock");

btnPlusQty.addEventListener("click", (event) => {
    let value = parseInt(inputQty.value);
    const maxValue = parseInt(maximumStock.value);
    if (value < maxValue) {
        value++;
        inputQty.value = value;
        inputQty.removeAttribute("disabled");
    } else {
        inputQty.setAttribute("disabled",true);
    }
});

btnMinusQty.addEventListener("click", (event) => {
    let value = parseInt(inputQty.value);
    if (value !== 0) {
        value--;
        inputQty.value = value;
        inputQty.removeAttribute("disabled");
    } else {
        inputQty.setAttribute("disabled",true);
    }
});
