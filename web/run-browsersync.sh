#!/bin/sh
browser-sync start --proxy "unattendedserver.local" --files "css/*.css,js/*.js,protected/views/site/*.php,protected/controllers/*.php,protected/views/layouts/*.php"
