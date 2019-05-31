#! /bin/sh

SCRIPT_DIR=$(cd $(dirname $0) && pwd)

php -S localhost:8000 -t $SCRIPT_DIR/../public_html/ &
 $1 $2