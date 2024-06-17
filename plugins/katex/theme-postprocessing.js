var mathElements;

function renderKaTeX(elements, displaymode)
{
	for (i = 0; i < elements.length; ++i)
	{
		katex.render(elements[i].innerHTML, elements[i], {
			displayMode: displaymode,
			output: 'htmlAndMathml',
			fleqn: false,
			throwOnError: false
		});
	}
}

// equasions of big scale
mathElements = document.getElementsByTagName('bigmath');
renderKaTeX(mathElements, true);

// inline maths
mathElements = document.getElementsByTagName('math');
renderKaTeX(mathElements, false);