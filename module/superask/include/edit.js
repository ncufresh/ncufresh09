function insertTags(edid, tagOpen, tagClose, sampleText)
{
	var txtarea = document.getElementById(edid);
// IE
	if (document.selection)
	{
		var theSelection = document.selection.createRange().text;
		var replaced = true;
		if (!theSelection)
		{
			replaced = false;
			theSelection = sampleText;
		}
		txtarea.focus();
// This has change
		var text = theSelection;
		if (theSelection.charAt(theSelection.length - 1) == " ")
		{
// exclude ending space char, if any
			theSelection = theSelection.substring(0, theSelection.length - 1);
			r = document.selection.createRange();
			r.text = tagOpen + theSelection + tagClose + " ";
		}
		else
		{
			r = document.selection.createRange();
			r.text = tagOpen + theSelection + tagClose;
		}
		if (!replaced)
		{
			r.moveStart('character',-text.length-tagClose.length);
			r.moveEnd('character',-tagClose.length);
		}
		r.select();
// Mozilla
	}
	else if (txtarea.selectionStart || txtarea.selectionStart == '0')
	{
		replaced = false;
		var startPos = txtarea.selectionStart;
		var endPos = txtarea.selectionEnd;
		if (endPos - startPos)
			replaced = true;
		var scrollTop = txtarea.scrollTop;
		var myText = (txtarea.value).substring(startPos, endPos);
		if (!myText)
			myText=sampleText;
		if (myText.charAt(myText.length - 1) == " ")
			subst = tagOpen + myText.substring(0, (myText.length - 1)) + tagClose + " ";
		else
			subst = tagOpen + myText + tagClose;
		txtarea.value = txtarea.value.substring(0, startPos) + subst + txtarea.value.substring(endPos, txtarea.value.length);
		txtarea.focus();
//set new selection
		if (replaced)
		{
			var cPos = startPos + (tagOpen.length + myText.length + tagClose.length);
			txtarea.selectionStart = cPos;
			txtarea.selectionEnd = cPos;
		}
		else
		{
			txtarea.selectionStart = startPos + tagOpen.length;
			txtarea.selectionEnd = startPos + tagOpen.length + myText.length;
		}
		txtarea.scrollTop = scrollTop;
	}
	else
	{
		var copy_alertText = 'Hello';
		var re1 = new RegExp("\\$1", "g");
		var re2 = new RegExp("\\$2", "g");
		copy_alertText = copy_alertText.replace(re1, sampleText);
		copy_alertText = copy_alertText.replace(re2, tagOpen + sampleText + tagClose);

		if (sampleText)
			text = prompt(copy_alertText);
		else
			text = "";
		if (!text)
			text = sampleText;
		text = tagOpen + text + tagClose;
//append to the end
		txtarea.value += "\n" + text;

		txtarea.focus();
	}
// reposition cursor if possible
	if (txtarea.createTextRange)
		txtarea.caretPos = document.selection.createRange().duplicate();
}

