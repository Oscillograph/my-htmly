// General functions
function htmlSpecialChars(str)
{
	str = str.replace(/\</gi, '&lt;');
	str = str.replace(/\>/gi, '&gt;');
	return str;
}

// HTML Tags
var tagCollection;

// Pre
tagCollection = document.getElementsByTagName('pre');
for (i = 0; i < tagCollection.length; ++i)
{
	tagCollection[i].innerHTML = htmlSpecialChars(tagCollection[i].innerHTML);
}


// BB-Tags
var match;
var temp;
var tagName;
var tagContent;
var mainsection = document.getElementById('mainsection');

function processTag(name, content)
{
	mainsection.innerHTML = mainsection.innerHTML.replace(name, content);
}

// box - general box with a header
tagName = /\[box="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]+?)\[\/box\]/gi;
tagContent = '<div class="gbox"><div class="header">$1</div><div class="gbox-content">$2</div></div>';
processTag(tagName, tagContent);

// boxr - right-aligned box
tagName = /\[boxr="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]+?)\[\/boxr\]/gi;
tagContent = '<div class="sidebar sidebar-right"><div class="header">$1</div><div class="sidebar-content">$2</div></div>';
processTag(tagName, tagContent);

// boxl - left-aligned box
tagName = /\[boxl="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]+?)\[\/boxl\]/gi;
tagContent = '<div class="sidebar sidebar-left"><div class="header">$1</div><div class="sidebar-content">$2</div></div>';
processTag(tagName, tagContent);

// boxc - center-aligned box
tagName = /\[boxc="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]+?)\[\/boxc\]/gi;
tagContent = '<center><div class="sidebar"><div class="header">$1</div><div class="sidebar-content">$2</div></div></center>';
processTag(tagName, tagContent);


// img - clickable image box with description
tagName = /\[img="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]*?)\[\/img\]/gi;
tagContent = '<table class="sidebar" style="border: 1px dashed #ffff00"><tr><td><a href="$1" target="_blank"><img src="$1" style="width: 100%"></a><hr></td></tr><tr><td><div class="sidebar-content" style="font-size: 0.75em">$2</div></td></tr></table>';
processTag(tagName, tagContent);

// img - clickable thumbnail image box with description
tagName = /\[img="?([\u0000-\uFFFF]+?)"? thumbnail="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]*?)\[\/img\]/gi;
tagContent = '<table class="sidebar" style="border: 1px dashed #ffff00"><tr><td><a href="$1" target="_blank"><img src="$2" style="width: 100%"></a><hr></td></tr><tr><td><div class="sidebar-content" style="font-size: 0.75em">$3</div></td></tr></table>';
processTag(tagName, tagContent);

/*
// img - clickable image box with description
tagName = /\[img="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]*?)\[\/img\]/gi;
tagContent = '<div class="gbox" style="border: 1px dashed #ffff00; display: inline-block; max-width: 300px"><a href="$1" target="_blank"><img src="$1" style="width: 100%"></a><hr><div class="gbox-content" style="font-size: 0.75em">$2</div></div>';
processTag(tagName, tagContent);

// img - clickable thumbnail image box with description
tagName = /\[img="?([\u0000-\uFFFF]+?)"? thumbnail="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]*?)\[\/img\]/gi;
tagContent = '<div class="gbox" style="border: 1px dashed #ffff00; display: inline-block; max-width: 300px"><a href="$1" target="_blank"><img src="$2" style="width: 100%"></a><hr><div class="gbox-content" style="font-size: 0.75em">$3</div></div>';
processTag(tagName, tagContent);
*/

// quote - quote from someone
tagName = /\[quote="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]+?)\[\/quote\]/gi;
tagContent = '<blockquote><p>$2</p>$1</blockquote>';
processTag(tagName, tagContent);

// url - hypertext link
tagName = /\[url="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]*?)\[\/url\]/gi;
tagContent = '<a href="$1" target="_blank">$2</a>';
processTag(tagName, tagContent);

// code - code box
tagName = /\[code\]([\u0000-\uFFFF]+?)\[\/code\]/gi;
tagContent = '<pre>$1</pre>';
match = mainsection.innerHTML.match(tagName);
if (match != null)
{
	for(i = 0; i < match.length; ++i)
	{
		temp = match[i];
		temp = htmlSpecialChars(temp);
		temp = temp.replace(tagName, tagContent);
		mainsection.innerHTML = mainsection.innerHTML.replace(tagName, temp);
	}
}

//more - spoiler box
tagName = /\[more="?([\u0000-\uFFFF]+?)"?\]([\u0000-\uFFFF]+?)\[\/more\]/gi;
tagContent = '<div class="spoiler"><div class="spoiler-head" onClick="javascript:toggle_spoiler_content(this);">[<span>+</span>] $1</div><div class="spoiler-content">$2</div></div>';
processTag(tagName, tagContent);

tagName = /\[more\]([\u0000-\uFFFF]+?)\[\/more\]/gi;
tagContent = '<div class="spoiler"><div class="spoiler-head" onClick="javascript:toggle_spoiler_content(this);">[<span>+</span>] Скрытый текст (тыкнуть мышкой, чтобы раскрыть)</div><div class="spoiler-content">$1</div></div>';
processTag(tagName, tagContent);

function toggle_spoiler_content(div)
{
	currentDisplay = div.nextSibling.style.display;
	div.nextSibling.style.display = (currentDisplay == 'block') ? 'none' : 'block';
	div.firstElementChild.innerHTML = (currentDisplay == 'block') ? '+' : '&#8211;';
}

// Красивости
// Тире вместо двойного дефиса
// !!! -- внутри тегов p и тегов с классом sidebar НЕ должно быть HTML-комментариев
function replaceDashes(el)
{
	el.innerHTML = el.innerHTML.replace(/--/g, '&#8211;');
}

var arr;

arr = document.getElementsByTagName('p');
for (i = 0; i < arr.length; ++i)
{
	replaceDashes(arr[i]);
}

arr = document.getElementsByTagName('span');
for (i = 0; i < arr.length; ++i)
{
	replaceDashes(arr[i]);
}

arr = document.getElementsByTagName('li');
for (i = 0; i < arr.length; ++i)
{
	replaceDashes(arr[i]);
}

arr = document.getElementsByClassName('sidebar');
for (i = 0; i < arr.length; ++i)
{
	replaceDashes(arr[i]);
}