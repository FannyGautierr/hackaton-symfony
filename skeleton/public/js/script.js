document.addEventListener('DOMContentLoaded', function() {
    const skiliftButton = document.getElementById("skilift-btn");
    const skitrackButton = document.getElementById("skitrack-btn");
    const skiliftDiv = document.querySelector(".all-lifts");
    const skitrackDiv = document.querySelector(".all-pistes");

    skiliftButton.addEventListener("click", () => {
        skitrackDiv.classList.add("hide");
        console.log('céfait')
        skiliftDiv.classList.remove("hide");
        console.log('céencorefé')
    });

    skitrackButton.addEventListener("click", () => {
        skiliftDiv.classList.add("hide");
        skitrackDiv.classList.remove("hide");
    });


    let slider=document.querySelector(".slider");
    let menu=document.querySelector("#navigation");
    menu.addEventListener("mouseover",function(){
        slider.style.display='block';
        const onMouseMove = (e) =>{
            slider.style.left = e.pageX + 'px';
        };
        document.addEventListener('mousemove', onMouseMove);
    });
    menu.addEventListener("mouseout",function(){
        slider.style.display='none';
    });


});




