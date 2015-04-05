SET GLOBAL general_log = 'ON';
SHOW VARIABLES WHERE Variable_name = 'general_log_file';
# or
SELECT @@general_log_file;

# in Terminal:
tail -f [path to file]
tail -f /Applications/MAMP/db/mysql/Retina.log