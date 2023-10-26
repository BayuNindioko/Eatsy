(function () {
    console.log("plusMinus.js loaded");

    const minusButtons = document.querySelectorAll(".minus");
    const plusButtons = document.querySelectorAll(".plus");
    const quantityInputs = document.querySelectorAll(".count");

    function updateQuantity(input, value) {
        console.log("Updating quantity");
        input.value = Math.max(parseInt(input.value) + value, 1);
    }

    minusButtons.forEach((button, index) => {
        button.addEventListener("click", function () {
            console.log("Minus button clicked");
            updateQuantity(quantityInputs[index], -1);
        });
    });

    plusButtons.forEach((button, index) => {
        button.addEventListener("click", function () {
            console.log("Plus button clicked");
            updateQuantity(quantityInputs[index], 1);
        });
    });
})();
