#!/bin/bash
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH
NOW=$(date +"%Y-%m-%d_%H:%M:%S")
mysqldump -u root -p'kgxgoodluck' kgx > 'kgx_'$NOW'.sql'
mv 'kgx_'$NOW'.sql' /root/kgx_database_backup/ 
