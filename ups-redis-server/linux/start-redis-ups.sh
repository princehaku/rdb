#!/bin/sh
r=`dirname $0`
$r/redis-ups-server $r/redis.conf &
