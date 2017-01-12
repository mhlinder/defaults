#!/bin/bash

for fn in `\ls md` ; do
    b=${fn%.*}
    if [[ $b =~ ^abstract.*$ ]]; then
        pandoc --template template.html -T "Title" --smart \
               -f markdown+link_attributes+header_attributes \
               -H html/abstractdata/abstractheader.php \
               -t html -o html/$b.html md/$fn
    else
        pandoc --template template.html -T "Title" --smart \
               -f markdown+link_attributes+header_attributes \
               -t html -o html/$b.html md/$fn
    fi
done

for fn in `\ls html | \grep 'abstract.*\.html'` ; do
    b=${fn%.*}
    mv html/$b.html html/$b.php
done

