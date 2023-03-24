document.addEventListener('DOMContentLoaded', function() {
    const skiliftButton = document.getElementById("skilift-btn");
    const skitrackButton = document.getElementById("skitrack-btn");
    const skiliftDiv = document.querySelector(".all-pistes");
    const skitrackDiv = document.querySelector(".all-lifts");

    skiliftButton.addEventListener("click", () => {
        console.log('remontées')
        skitrackDiv.classList.add("hide");
        skiliftDiv.classList.remove("hide");
    });

    skitrackButton.addEventListener("click", () => {
        console.log('pistes')
        skiliftDiv.classList.add("hide");
        skitrackDiv.classList.remove("hide");
    });
});


