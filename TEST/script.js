

let rows = document.querySelectorAll('.rows')
let box = document.querySelectorAll('.seatt');
let seats = [];
var count = 0;

let c = 0;
let r = 0;
for (let a = 0; a < box.length; a++) {
    ++c;
}
for (let b = 0; b < rows.length; b++) {
    ++r;
}
const col = c / r;
const re = (c) - (col);
console.log(re)




for (let i = 0; i < box.length; i++) {
    box[i].addEventListener("click", () => {

        if (box[i].classList.toggle("selected")) {
            ++count;
            if (count == 1) {
                seats[i] = i + 1;
            }
            else {
                seats[i] = " " + (i + 1);
            }
        }
        else {
            --count;
            seats[i] = '';
        }
        document.getElementById("demo").innerHTML = seats.join('');
        document.getElementById("co").innerHTML = count;
    });
}








// for (let i = 0; i < box.length; i++) {

//     box[i].addEventListener("click", ()=> {

//         if (box[i].classList.toggle("selected")) {
//             ++count;
//             if (count == 1) {
//                 seats[i] = i+1;
//             }
//             else {
//                 seats[i] = " "+ (i+1);
//             }
//         }
//         else {
//             --count;
//             seats[i] = '';
//         }
//         document.getElementById("demo").innerHTML = seats.join('');
//         document.getElementById("co").innerHTML = count;
//     },false);
// }





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