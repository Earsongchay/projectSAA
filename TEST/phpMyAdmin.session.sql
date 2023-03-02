SELECT movie_title,branch_name,start_time, durations,ticket_price, movie_image,categorie_id  FROM movies m join scheduleDetails sd ON m.movie_id = sd.movie_id JOIN branches_halls bh ON bh.hall_branch_id = sd.hall_branch_id JOIN Branches b ON b.branch_id = bh.branch_id WHERE scheduleDetail_id = 23;

