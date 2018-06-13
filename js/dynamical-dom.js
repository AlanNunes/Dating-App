/**
 * Created by Luan on 23/03/2018.
 */

//Class Creation
function DOM_Element() {
    this.initialize.apply(this, arguments);
}

/*
Initial setup
element: html element name
nodeClass: class to add to the element
nodeId: id to add to element
attributes: array of attributes to add to element as json ex: {name: 'name', value: 'value'}
content: content that goes between the open and close tags ex: <p>Text...</p>
 */
DOM_Element.prototype.initialize = function(element, nodeClass, nodeId, attributes, content){
    var self = this;
    this.element = document.createElement(element);
    attributes = attributes || [];
    if(content) this.element.innerHTML = content;
    if(nodeClass) this.element.className = nodeClass;
    if(nodeId) this.element.id = nodeId;
    $(document).ready(function() {
        for(var i = 0;i < attributes.length;i++) {
            var attribute = attributes[i];
            $(self.element).attr(attribute.name, attribute.value);
        }
    });
};

/*
Add as a child of given DOM element
DOMElement: element from document to which add the element
 nodeIsDom: set to true if object is not a stance of DOM_Element
 */
DOM_Element.prototype.addToDOM = function(DOMElement, nodeIsDom) {
    var DOMNode = nodeIsDom ? DOMElement.element : DOMElement;
    DOMNode.appendChild(this.element);
};

/*
Add node as a child of this element
node: element to be added as child
nodeIsDOM: set to true if node is not a stance of DOM_Element
 */
DOM_Element.prototype.appendChild = function(node, nodeIsDOM) {
    var element = nodeIsDOM ? node : node.element;
    this.element.appendChild(element);
};

/*
Change the content that goes between the html tags ex: <p>Text...</p>
content: the content to be added to element.
 */
DOM_Element.prototype.changeContent = function(content) {
    this.element.innerHTML = content;
};

/*
Change the class of the element
nodeClass: the class to added
 */
DOM_Element.prototype.changeClass = function(nodeClass) {
    this.element.className = nodeClass;
};

/*
Change the attributes of the element
attribute: json with the attribute to be added ex: {name: 'attributeName', value: 'attributeValue'}
 */
DOM_Element.prototype.changeAttribute = function(attribute) {
    var self = this;
    $(document).ready(function() {
        $(this.element).attr(attribute.name, attribute.value);
    });
};

DOM_Element.prototype.click = function(handler) {
    var self = this;
    $(document).ready(function() {
        $(self.element).click(handler);
    })
};

DOM_Element.prototype.removeClick = function() {
    var self = this;
    $(document).ready(function(){
        $(self.element).unbind("click");
    });
};

DOM_Element.prototype.mouseDown = function(handler) {
    var self = this;
    $(document).ready(function (){
        $(self.element).mousedown(handler);
    });
};

DOM_Element.prototype.removeMouseDown = function() {
    var self = this;
    $(document).ready(function() {
        $(self.element).unbind("mousedown");
    });
};

DOM_Element.prototype.mouseUp = function(handler) {
    var self = this;
    $(document).ready(function() {
        $(self.element).mouseup(handler);
    })
};

DOM_Element.prototype.removeMouseUp = function() {
    var self = this;
    $(document).ready(function() {
        $(self.element).unbind("mouseup");
    })
};

DOM_Element.prototype.hover = function(handlerIn, handlerOut) {
    var self = this;
    $(document).ready(function() {
        $(self.element).hover(handlerIn, handlerOut);
    });
};

DOM_Element.prototype.removeHover = function() {
    var self = this;
    $(document).ready(function() {
        $(self.element).unbind("mouseenter mouseleave");
    })
};

DOM_Element.prototype.mouseEnter = function(handler) {
    var self = this;
    $(document).ready(function() {
        $(self.element).mouseenter(handler);
    });
};

DOM_Element.prototype.removeMouseEnter = function() {
    var self = this;
    $(document).redy(function() {
        $(self.element).unbind("mouseenter");
    });
};

DOM_Element.prototype.mouseLeave = function(handler) {
    var self = this;
    $(document).ready(function() {
        $(self.element).mouseleave(handler);
    });
};

DOM_Element.prototype.removeMouseLeave = function() {
    var self = this;
    $(document).ready(function() {
        $(self.element).unbind("mouseleave");
    });
};