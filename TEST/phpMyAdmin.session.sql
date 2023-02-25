SELECT h.seat_id ,rows_number, seat_number,sd.scheduledetail_id FROM seats
            JOIN halls h ON h.seat_id = seats.seat_id JOIN Branches_Halls bh ON bh.hall_id = h.hall_id JOIN scheduleDetails sd ON sd.hall_branch_id = bh.hall_branch_id
            WHERE sd.scheduledetail_id = 23