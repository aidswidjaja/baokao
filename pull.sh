#!/bin/bash

echo "Running pull script"
sudo git pull
echo "Restarting Apache2 via System V"
sudo service apache2 restart
echo "Finished!"