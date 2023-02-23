SELECT seats_booked ,seat_number,rows_number
from bookingdetails bi JOIN scheduledetails sd
ON bi.scheduleDetail_id=sd.scheduleDetail_id
JOIN branches_halls bh
ON bh.hall_branch_id=sd.hall_branch_id
JOIN halls h
ON h.hall_id=bh.hall_id
JOIN seats s 
ON s.seat_id = h.seat_id; 