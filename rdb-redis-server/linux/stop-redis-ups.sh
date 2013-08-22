#!/bin/sh
r=`dirname $0`
kill `cat $r/1.pid`
