SET GLOBAL general_log = 'ON';
SELECT @@general_log_file;
# Or: SHOW VARIABLES WHERE Variable_name = 'general_log_file';

# In Terminal:
tail -f [path to file]
tail -f /Applications/MAMP/db/mysql/Retina.log
tail -f /Library/Application\ Support/appsolute/MAMP\ PRO/db/mysql/Retina.log