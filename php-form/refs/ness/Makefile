
.PHONY: all html lab push

all: html lab

html:
	bash compile.sh

lab:
	rsync -av --exclude=.git . lab1:~/scratch/ness17

push:
	bash push.sh

