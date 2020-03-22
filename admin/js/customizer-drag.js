const dragElementQuery = '.sidebar-item';
const mainElementQuery = 'main > section > *';
const dropzoneQuery = '.dropzone';

// All the underlying constants return a nodeList
const dropzoneElement = document.querySelectorAll(dropzoneQuery);
const mainElement = document.querySelectorAll(mainElementQuery);
const dragElement = document.querySelectorAll(dragElementQuery);

/**
 * This is my new approach to the setup of the
 * event listeners.
 */
var dropzoneElementsArray = [];
var mainElementsArray = [];
var dragElementsArray = [];

for (var i = 0; i < dropzoneElement.length; i++) {
  dropzoneElementsArray.push(dropzoneElement[i]);
}

for (var j = 0; j < dropzoneElement.length; j++) {
  dropzoneElementsArray.push(dropzoneElement[j]);
}

for (var k = 0; k < dropzoneElement.length; k++) {
  dropzoneElementsArray.push(dropzoneElement[k]);
}

dropzoneElementsArray.forEach(function (item) {
  console.log('Did tings')
});


/**
 * This is a ECMA5 hacky way of using forEach on a nodeList,
 * since this functionality exists only for variable of the
 * type Array.
 */
[].forEach.call(mainElement, function (mainElement) {
  mainElement.addEventListener('dragenter', handleDragEnter, false)
  mainElement.addEventListener('dragover', handleDragOver, false);
  mainElement.addEventListener('dragleave', handleDragLeave, false);
  mainElement.addEventListener('drop', dropMain, false);
});

[].forEach.call(dropzoneElement, function (dropzoneElement) {
  dropzoneElement.addEventListener('drop', handleDrop, false);
});

[].forEach.call(dragElement, function (dragElement) {
  dragElement.addEventListener('dragstart', handleDragStart, false);
  dragElement.addEventListener('dragend', handleDragEnd, false);
});


/**
 * When the user starts dragging a dragElement,
 * lower the opacity of the source and allow data
 * to be transferred.
 */
function handleDragStart(e) { // this & e.target: source node.

  this.style.opacity = '0.4';

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.dataset.type);

}


/**
 * Prepare the data to be dropped when the handle
 * hovers over a mainElement.
 */
function handleDragOver(e) { // this & e.target: current hover target.
  if (e.preventDefault) {
    e.preventDefault();
  }

  var hoverTop;

  e.offsetY / this.scrollHeight < 0.5 ? hoverTop = true : hoverTop = false;

  console.log(hoverTop);

  if (hoverTop) {
    // Get y coords of the middle of the element before:  yPrevious
    // Get y coords of the target element:                yCurrent
    // Make an pos: abs Draghover element and make it have a top of yPrevious and height of yCurrent - yPrevious
  }


  e.dataTransfer.dropEffect = 'move';

  return false;

}


/**
 * When the handle hovers over a target, add the
 * 'over' class and add a dropzone before and
 * after the element.
 */
function handleDragEnter(e) { // this & e.target: current hover target.

  this.classList.add('over');

  var targetElement = document.createElement('div');
  targetElement.classList.add('dropzone');
  targetElement.style.display = 'block';

  var targetElement2 = document.createElement('div');
  targetElement2.classList.add('dropzone');
  targetElement2.style.display = 'block';

  if (!this.classList.contains('dropzone')) {
    // Prototype functions are found in main.js
    targetElement.appendBefore(this);
    targetElement2.appendAfter(this);
  }

}


/**
 * When the handle leaves the element, remove the
 * 'over' class and remove all dropzones.
 */
function handleDragLeave(e) { // this & e.target: previous target element.

  this.classList.remove('over');

  if (this.nextElementSibling && this.nextElementSibling.classList.contains('dropzone')) {
    this.nextElementSibling.remove();
    this.previousElementSibling.remove();
  }
}


/**
 * When the handle is dropped over an accepted
 * dropzone, check it's data and generate an
 * element accordingly, then replace the dropzone
 * with the newly generated element.
 */
function handleDrop(e) { // this & e.target: target element.

  if (e.stopPropagation) {
    e.stopPropagation();
  }

  var datatype = e.dataTransfer.getData('text/html');
  var generatedElement;
  var generatedContent;

  console.log(datatype);

  switch (datatype) {
    case 'text':
      generatedElement = document.createElement("p");
      generatedContent = document.createTextNode("This is a text element.");
      generatedElement.appendChild(generatedContent);
      break;
    case 'image':
      generatedElement = new Image(1000);
      generatedElement.src = 'https://www.jezz.tech/img/tnm-bw.jpg';
      break;
    default:
      generatedElement = document.createElement("p");
      generatedElement.classList.add('invalid');
      generatedContent = document.createTextNode("This data type is not yet implemented.");
      generatedElement.appendChild(generatedContent);
  }

  // this.innerHTML = generatedElement;
  this.replaceWith(generatedElement);

  return false;
}


/**
 * When the handle is dropped over an any main
 * element that isn't an accepted dropzone, remove
 * the 'over' class and both dropzones.
 */
function dropMain(e) { // this & e.target: target element.

  if (e.stopPropagation) {
    e.stopPropagation();
  }

  this.classList.remove('over');

  if (this.nextElementSibling && this.nextElementSibling.classList.contains('dropzone')) {
    this.nextElementSibling.remove();
  }

  return false;
}


/**
 * When all the dragging is done and the drop has
 * been handled, return the source node styling to
 * normal and remove all 'over' classes that are
 * left.
 */
function handleDragEnd(e) { // this & e.target: source node.

  this.style.opacity = '1';

  [].forEach.call(mainElement, function (mainElement) {
    mainElement.classList.remove('over');
  });
}



