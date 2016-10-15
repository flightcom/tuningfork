#!/bin/sh

# Positional arguments:
# $1    The version (including the version prefix)

VERSION=$1

sed -e 's/\"version\"\: \"\([0-9]*\.[0-9]*\.[0-9]*\)\"/\"version\": \"'$VERSION'\"/g' -i "" bower.json
sed -e 's/\"version\"\: \"\([0-9]*\.[0-9]*\.[0-9]*\)\"/\"version\": \"'$VERSION'\"/g' -i "" package.json
