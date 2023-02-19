SELECT hall_branch_id FROM branches_halls WHERE 
hall_id NOT IN (SELECT hall_id from halls)
AND branch_id NOT IN (SELECT branch_id from branches);
            