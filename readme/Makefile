pdf: tex
	pdflatex Readme_template.tex
	pdflatex Readme_template.tex
tex:
	pandoc -o Readme.tex Readme.md
clean:
	rm Readme_template.aux Readme_template.bbl Readme_template.blg Readme_template.log Readme.tex
