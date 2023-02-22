
    var booked = document.getElementById('bseat').getAttribute('value').split(",");
    var r = [];
    var c = [];
    console.log(booked);

    const b = document.getElementsByTagName('div');
    b.AddEventListener("click",(e)=>{
        this.classList.add('active');
    });
    for (let i = 0; i < booked.length; i++) {
        if (booked[i].charAt(0) == 'A') {
            r[i] = 1;
            c[i] = booked[i].replace('A', '');
        } else if (booked[i].charAt(0) == 'B') {
            r[i] = 2;
            c[i] = booked[i].replace('B', '');
        } else if (booked[i].charAt(0) == 'C') {
            r[i] = 3;
            c[i] = booked[i].replace('C', '');
        } else if (booked[i].charAt(0) == 'D') {
            r[i] = 4;
            c[i] = booked[i].replace('D', '');
        } else if (booked[i].charAt(0) == 'E') {
            r[i] = 5;
            c[i] = booked[i].replace('E', '');
        } else if (booked[i].charAt(0) == 'F') {
            r[i] = 6;
            c[i] = booked[i].replace('F', '');
        } else if (booked[i].charAt(0) == 'G') {
            r[i] = 7;
            c[i] = booked[i].replace('G', '');
        }

    }
    var search = [];
    for (let i = 0; i < r.length; i++) {
        search[i] = r[i] + '' + c[i];
    }
    
    console.log(search);
    
    let table = document.getElementById('table');
    var col = document.getElementById('col').getAttribute('value');
    var row = document.getElementById('row').getAttribute('value');
    console.log(col + " " + row);
    for (let i = 1; i <= row; i++) {
        for (let j = 1; j <= col; j++) {
            if (search[j - 1] == i + '' + j) {
                var z = document.getElementById(search[j - 1]);
                z.classList.add('active');
            }
        }
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