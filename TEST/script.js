
let box = document.querySelectorAll('.seat');
let seats = [];
let re;
var count = 0;
for (let i = 0; i < box.length; i++) {

    box[i].addEventListener("click", ()=> {

        if (box[i].classList.toggle("active")) {
            ++count;
            if (count == 1) {
                seats[i] = i+1;
            }
            else {
                seats[i] = " "+ (i+1);
            }
        }
        else {
            --count;
            seats[i] = '';
        }
        document.getElementById("demo").innerHTML = seats.join('');
        document.getElementById("co").innerHTML = count;
    },false);
}





// let times = document.querySelectorAll('.uil-times')
// let btnsearch = document.querySelectorAll('.uil-search')
// let search = document.querySelectorAll('.search')

// for (let i = 0; i < btnsearch.length; i++) {
//     btnsearch[i].addEventListener("click",function(){
//         search[i].classList.add("active")
//     })

//     times[i].addEventListener("click",function(){
//         search[i].classList.remove("active")
//     })
// }