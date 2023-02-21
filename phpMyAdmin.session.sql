SELECT start_time 
FROM scheduledetails sd JOIN branches_halls bh
ON sd.hall_branch_id = bh.hall_branch_id
JOIN branches b
ON b.branch_id=bh.branch_id
JOIN halls h
ON h.hall_id=bh.hall_id
WHERE movie_id=1 
AND start_time>NOW() 
AND branch_name="AEON MALL"
AND hall_name="THEATRE D ( IMAX )";
            