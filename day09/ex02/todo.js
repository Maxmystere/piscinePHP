function createElem() {
	var newElem = document.createElement("div");
	newElem.appendChild(document.createTextNode("Hello World"));
	document.getElementById('ft_list').appendChild(newElem);
}

