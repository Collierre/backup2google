#!/bin/bash

if [ $# -lt 2 ]; then
    echo "Two arguments required: frequency type (e.g. daily), and number of backups to keep for this frequency (e.g. 7 for daily backups)"
    echo "e.g. ./mysqlbkup.sh weekly 4"
    exit
fi

frequency=$1
backupstokeep=$2

# Include database details
. config.sh

# Specify the temporary backup directory.
bkupdir=$bkupdirid\_db_backups/$frequency

# Save the current date
date=`date '+%Y-%m-%d-%s'`

# Create backupdir if it doesn't exist
if [ ! -d "$bkupdir" ]; then
    mkdir -p $bkupdir
fi

# Dump the mysql database with the current date and compress it.
# Save the mysql password in a file and specify the password file
# path in the below command.

echo "Dumping database $dbname to $bkupdir/$date_$frequency_$dbname.sql.gz"
mysqldump -u $dbuser -p$dbpass $dbname \
 | gzip > $bkupdir/$date\_$frequency\_$dbname.sql.gz


# Upload the new file to google drive

php addfile.php $bkupdir/$date\_$frequency\_$dbname.sql.gz $frequency

# If the maximum number of backups for this backup period type has been reached, remove the oldest one. then remove it from google drive.

numbackups=$(ls -1 $bkupdir | wc -l)
while [ $numbackups -gt $backupstokeep ]; do
    filetodelete=$(ls -1 $bkupdir | head -n1)
    echo "Deleting $filetodelete from filesystem"
    rm $bkupdir/$filetodelete
    php deletefile.php $filetodelete
    numbackups=$(ls -1 $bkupdir | wc -l)
done

