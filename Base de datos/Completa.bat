@echo off
set DATE=%date:~-4,4%.%date:~-10,2%.%date:~-7,2%_%time:~-11,2%.%time:~-8,2%
set BACKUP_DIR="C:\Users\Juan\Desktop\BBDD"
set DB_USER="root"
set DB_PASSWORD="root"
set DB_NAME="proyecto"

"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysqldump.exe" -u%DB_USER% -p%DB_PASSWORD% %DB_NAME% > %BACKUP_DIR%\full_backup_%DATE%.sql