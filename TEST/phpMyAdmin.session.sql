SELECT distinct branch_name,bh.branch_id,distinct date(start_time) FROM scheduledetails sd JOIN branches_halls bh on bh.hall_branch_id = sd.hall_branch_id JOIN branches b on bh.branch_id = b.branch_id
                                WHERE sd.movie_id = 24 AND end_time > NOW();

