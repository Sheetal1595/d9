let digiClock = document.querySelector("#digital-clock");
console.log(digiClock);

function digiClock(){
    let today = new Date();
    today = today.toLocaleString();
    return today;
}
function myClock(){
    
    digiClock.innerText = digiClock();

}

setInterval(myClock,1000);