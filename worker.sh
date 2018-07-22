#!/usr/bin/env bash
#!/bin/sh
# filename: worker.sh


loop=0
while [ $loop -lt 60 ]; do
         php -f /var/www/html/Queue/worker.php &
          sleep 1
  loop=$(($loop+1))
done

