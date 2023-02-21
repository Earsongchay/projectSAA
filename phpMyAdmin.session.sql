SELECT hall_name from halls h join branches_halls bh on h.hall_id = bh.hall_id join scheduledetails sd on sd.hall_branch_id = bh.hall_branch_id join branches b on bh.branch_id = b.branch_id
                             where sd.movie_id = 1 and end_time > now() and b.branch_name = 'AEON MALL' 
            