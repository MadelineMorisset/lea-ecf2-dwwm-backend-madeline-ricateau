SELECT * 
FROM link_comment 
WHERE id_link = ?
ORDER BY date_comment DESC, heure_comment DESC