<style>
    tr {
        display: flex;
        gap: 10px;
    }

    td {
        cursor: pointer;
        background-color: #444451;
        height: 26px;
        width: 32px;
        margin: 3px;
        font-size: 50px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        font-size: 20px;
        text-align: center;
        color: white;
    }

    .box.active {
        background-color: green;
    }

    .active {
        background-color: red;
    }
</style>
<h3>Count: <span id="count"></span></h3>
<h4>Seat: <span id="seat"></span></h4>
<table id="table">
    <tr value="1" id='row'>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<script>
   // let table = document.getElementById('table'),
        rindex, cindex;


    let seats = [];
    let count = 0;

    for (var i = 0; i < table.rows.length; i++) {

        for (var j = 0; j < table.rows[i].cells.length; j++) {

            table.rows[i].cells[j].onclick = function() {
                rindex = this.parentElement.rowIndex;
                cindex = this.cellIndex;
                var r = rindex + 1;
                var c = cindex + 1;
                if (r == 1) {
                    r = "A"
                } else if (r == 2) {
                    r = "B"
                } else if (r == 3) {
                    r = "C"
                } else if (r == 4) {
                    r = "D"
                } else if (r == 5) {
                    r = "E"
                } else {
                    r = "F"
                }


                console.log(r)
                if (this.classList.toggle(active)) {
                    ++count;
                    seats.push(`${r}${c}`)
                    // let ind = seats.indexOf(`${r}-${c}`)
                    // console.log(Number(`${c}`))covert to number

                } else {
                    --count;
                    let inde = seats.indexOf(`${r}${c}`)
                    seats.splice(inde, 1)
                }

                document.getElementById('seat').innerHTML = seats.sort().reverse();
                document.getElementById('count').innerHTML = count;

            }
        }
    }
</script>

<script>

</script>
<script>
    var booked = document.getElementById('bseat').getAttribute('value').split(",");
    var r = [];
    var c = [];
    console.log(booked);

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
    let table = document.getElementById('table');
    var col = document.getElementById('booked_c').getAttribute('value');
    var row = document.getElementById('booked_r').getAttribute('value');

    for (let i = 1; i <= row; i++) {

        if (i == r[i - 1]) {
            for (let j = 1; j <= col; j++) {
                if (j == c[j - 1]) {
                    alert(j + " " + i);

                }
            }
        }
    }
</script>