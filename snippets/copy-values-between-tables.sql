UPDATE log, images
SET log.image_id = images.id
WHERE log.image_name = images.image_name;
