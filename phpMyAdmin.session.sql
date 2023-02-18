SELECT scheduledetail_id,end_time,movie_title from scheduledetails join movies
on movies.movie_id=scheduledetails.movie_id
where scheduledetails.movie_id=1 AND
end_time < now();