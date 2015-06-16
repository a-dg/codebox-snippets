SET @from_domain = '//from.dev';
SET @to_domain = '//to.com';
SET @prefix = 'wp';

SET @s1 = CONCAT('UPDATE ', @prefix, '_posts SET post_content = replace(post_content, "', @from_domain,'", "', @to_domain,'");');
SET @s2 = CONCAT('UPDATE ', @prefix, '_options SET option_value = replace(option_value, "', @from_domain,'", "', @to_domain,'") WHERE option_name="home" OR option_name = "siteurl"');
SET @s3 = CONCAT('UPDATE ', @prefix, '_postmeta SET meta_value = replace(meta_value, "', @from_domain,'", "', @to_domain,'");');
SET @s4 = CONCAT('UPDATE ', @prefix, '_posts SET guid = replace(guid, "', @from_domain,'", "', @to_domain,'");');

PREPARE s1 FROM @s1;
EXECUTE s1;
DEALLOCATE PREPARE s1;

PREPARE s2 FROM @s2;
EXECUTE s2;
DEALLOCATE PREPARE s2;

PREPARE s3 FROM @s3;
EXECUTE s3;
DEALLOCATE PREPARE s3;

PREPARE s4 FROM @s4;
EXECUTE s4;
DEALLOCATE PREPARE s4;