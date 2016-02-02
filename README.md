# JavaScript can do WHAT?!

An overview of the latest capabilities from the JavaScript Web Development scene. includes overviews of the benefits and when to use, for the following:

* A brief history of JavaScript (90s, 00s, Prototype, jQuery, Backbone, TodoMVC, Virtual DOM, Node, Servers, Desktop)
* The latest ECMAScript standards (ES6+). Discover native classes, promises for easy async, where promises fall short. How to compile ES6+ code today (Babel).
* Node: Short history of Node.js, it’s usages over time (servers, command line apps, robotics, desktop apps), things to know
* Build tools and generators: Introduction to Grunt, Gulp, NPM Scripts, and Static Site Generators like DocPad
* Browser innovations like WebRTC for webcam, microphone, and peer 2 peer communication - think video chat apps and netflix
* Browser hinderances like the DOM and the introduction of the Virtual DOM (React.js) as well as creating native iOS applications using React’s Virtual DOM using React Native

Suitable for beginners and professionals. Will describe each section, and touch on basic examples. Depth is available on questions.

## History

### 1995+ Forms
JavaScript and the DOM were still very basic, with many browser inconsistencies.
JavaScript was not the only player, VBScript and JScript were also possible.
CSS was still emerging and required [evanglisism](http://www.csszengarden.com/).
JavaScript was used almost exclusively for mere form validation and alerts/prompts.
Think of your typical email form validation.

[Example.](./01.php)

``` html
<form action="" method="post" onsubmit="return confirm('Are you sure?')">
```

- Problem: <span class="step">Validation existed on the client-side and on the server-side (if lucky). This duplicated effort, was often not done, and often resulted in inconsistent validation.</span>
- Solution: <span class="step">Somehow use client-side to request the server-side logic.</span>

### 2000+ XHR
JavaScript became consistent, however features across browsers were still inconsistent.
In 1999 and the years following, different browsers provided JavaScript access to server-side communication via the [XHR/XMLHttpRequest/AJAX](https://en.wikipedia.org/wiki/XMLHttpRequest) standard.
This was primarily used at the time for consolidating form validation to the server-side, for consistent and secure validation.
Think of your typical yet simple government form validation.

[Example.](./02.php)

``` javascript
var request = new XMLHttpRequest()
request.onreadystatechange = function () {
	if (this.readyState === 4) {
        var result = JSON.parse(request.responseText)
        if ( !result.success ) {
            throw new Error(result.message || 'Validation of the form failed')
        }
	}
}
```

- Problem: <span class="step">Proper server-side validation and communication allowed better apps to be developed, and consequently more complex applications</span>
- Solution: <span class="step">Browsers were not yet ready for the requirements of the applications that were being built for them. Libraries came to the rescue.</span>

In later years, this technology would be used for polling to emulate Web Socket technology  for server to client notifications and communication.

### 2005+ Libraries
In this time, JavaScript was becoming necessary to accomplish more advanced browser functions, such as form validation, page interactions, and animations.
Think of JavaScript's usage in early WordPress versions.

#### Vanilla

#### Prototype.js
In early 2005, [Prototype.js](https://en.wikipedia.org/wiki/Prototype_JavaScript_Framework) came out, accomplishing Object Orientated techniques, notably by [monkey-patching](https://en.wikipedia.org/wiki/Monkey_patch) native classes.
In mid 2005, [Scriptaculous.](https://en.wikipedia.org/wiki/Script.aculo.us) came out, accomplishing visual [animations](http://madrobby.github.io/scriptaculous/combination-effects-demo/) and interactions.
[Example.](https://github.com/balupton/jquery-sparkle/blob/master/scripts/resources/core.string.js).

``` javascript
document.getElementById('myel').style.color = 'red'
document.getElementById('myel').setStyle({color: 'green'})
$('myel').setStyle({color: 'white'})
```

- Problem: <span class="step">Different libraries and code often depending on different variations of a native prototype extension. Browsers couldn't agree either.</span>
- Solution: <span class="step">Move extensions into their own classes.</span>

#### MooTools

In late 2006, [MooTools](https://en.wikipedia.org/wiki/MooTools) came out, accomplishing Object Orientated techniques, notably by new class types.

``` javascript
var Animal = new Class({
    initialize: function(name) {
        this.name = name;
    }
})
var Cat = new Class({
    Extends: Animal,
    talk: function() {
        return 'Meow!';
    }
})
var Dog = new Class({
    Extends: Animal,
    talk: function() {
        return 'Arf! Arf';
    }
})
var animals = {
    a: new Cat('Missy'),
    b: new Cat('Mr. Bojangles'),
    c: new Dog('Lassie')
}
Object.each(animals, function (animal) {
    alert(animal.name + ': ' + animal.talk())
})
```

- Problem: <span class="step">Code often became overly verbose, was complicated for beginners, and didn't make use of nice parts of JavaScript.</span>
- Solution: <span class="step">No one really new at the time what the solution was for making ugly JavaScript beginner friendly</span>

#### jQuery

In late 2006, [jQuery](https://en.wikipedia.org/wiki/JQuery) came out, accomplishing Object Orientated techniques, notably by simplistic chaining and beginner friendly API - OO without thinking about it.
In late 2007, [jQuery UI](https://en.wikipedia.org/wiki/JQuery_UI) came out, accomplishing visual animations and interactions via widgets.

``` javascript
$.prototype.log = function () {
	var $el = this
	alert($el.html())
}
$('p.surprise').addClass('ohmy').show('slow').log()
```

- Problem: <span class="step">Was great at interacting with the DOM, however didn't give us techniques for building apps.</span>
- Solution: <span class="step">No one really new at the time what the solution was for creating manageable and powerful web apps.</span>


#### Simple JavaScript Inheritance

In early 2008, [John Resig](http://ejohn.org) (author of jQuery) published [Simple JavaScript Inheritance](http://ejohn.org/blog/simple-javascript-inheritance/), a 25 line utility that effectively emulated proper classes in JavaScript.

``` javascript
var Person = Class.extend({
  init: function(isDancing){
    this.dancing = isDancing
  },
  dance: function(){
    return this.dancing
  }
});
 
var Ninja = Person.extend({
	init: function(){
		this._super(false)
	},
	dance: function(){
		// Call the inherited version of dance()
		return this._super()
	},
	swingSword: function(){
		return true
	}
});
 
var p = new Person(true)
p.dance() // => true
 
var n = new Ninja()
n.dance() // => false
n.swingSword() // => true
 
// Should all be true
p instanceof Person && p instanceof Class &&
n instanceof Ninja && n instanceof Person && n instanceof Class
```


### 2005+ Early State Management
In this time, JavaScript was also seeing use in early Content Management Systems, requiring page transitions and state management.
Think of your typical multi-part form submission flow.

#### HashChange

In 2008, [`window.onhashchange`](https://developer.mozilla.org/en-US/docs/Web/Events/hashchange) came out in some browsers (with others following), accomplishing the first unintended browser-supported way of accomplishing state management inside web browsers:
[Example.](http://balupton.github.io/jquery-history/demo/)

``` javascript
window.location.onhashchange = function () {
	alert('hash:', window.location.hash)
}
window.location.hash = 'one'  // alerts "hash: one"
window.location.hash = 'two'  // alerts "hash: two"
history.back()  // alerts "hash: one"
```

- Problem: <span class="step">Website would need to be loaded twice — once for the initial landing state, then again for the actual hash state. SEO required client-side and server-side architecture decisions.</span>
- Solution: <span class="step">More [advanced libraries](http://balupton.github.io/jquery-ajaxy/demo/) were developed, while waiting for browsers to provide a proper API for managing state.</span>

#### History API

In 2011, [`window.onpopstate`](https://developer.mozilla.org/en-US/docs/Web/Events/popstate) came out in some browsers (with others following), accomplishing the first intended browser-supported way of accomplishing state management inside web browsers:

``` javascript
window.location.onpopstate = function () {
	alert('location: ' + document.location.href + ', and the state has changed to: ' + JSON.stringify(event.state))
}
history.pushState({page: 1}, "title 1", "?page=1");
history.pushState({page: 2}, "title 2", "?page=2");
history.replaceState({page: 3}, "title 3", "?page=3");
history.back(); // alerts "location: http://example.com/example.html?page=1, state: {"page":1}"
history.back(); // alerts "location: http://example.com/example.html, state: null
history.go(2);  // alerts "location: http://example.com/example.html?page=3, state: {"page":3}
```

- Problem: <span class="step">Not all browsers supported this at all or consistently.</span>
- Solution: <span class="step">[Education](https://github.com/browserstate/history.js/wiki/Intelligent-State-Handling) and [polyfills](https://github.com/browserstate/history.js/) were developed by the community.</span>


### 2008+ Early Single Page Web Applications
In this time, JavaScript was seeing good cross-browser consistency (for the most part), advanced server-side backends, and the emergency of Client-Side Web Applications.
Think of your typical Facebook commenting workflow.

In 2008, [client-side templating engines](http://balupton.github.io/jquery-smarty/demo/) started to come out, accomplishing server-side style templating on the client-side.
There would later go on to become very popular.

``` html
<div class="smarty">
	{$myvar|default:"hi"|capitalize}
	{assign var="myvar" value="hello"}
	{$myvar|default:"hi"|capitalize}
</div>
<script>$('.smarty').populate()</script>
```

- Problem: <span class="step">They just tackled the view layer of web applications, rather than the model or controller layers. So other view layer technologies like jQuery remained.</span>
- Solution: <span class="step">Libraries would need to come out that tackled the model and controller layers.</span>

In late 2010, [Backbone](https://en.wikipedia.org/wiki/Backbone.js) came out, accomplishing organised Client-Side Web Applications, notably by the MVC pattern.

``` javascript
var MessageList = Backbone.View.extend({
	initialize: function() {
		var messages = this.collection
		messages.on("reset", this.render, this)
		messages.on("add", this.addMessage, this)
		messages.on("remove", this.removeMessage, this)
		messsages.each(this.addMessage, this)
	}
})
// Later, in the app...
Inbox.messages.add(newMessage);
```

- Problem: <span class="step">While the model and controller layers were fantastic, the view layer was too primitive.</span>
- Solution: <span class="step">View layer was partnered with templating libraries and engines, however things like nested views in lists remained difficult to manage.</span>

In 2012, other client-side application libraries reached maturity, such as [Angular](https://en.wikipedia.org/wiki/AngularJS) and [Ember](https://en.wikipedia.org/wiki/Ember.js), and the [TodoMVC](https://github.com/tastejs/todomvc) project was created.

- Problem: <span class="step">Client-side applications were starting to get overly complicated, slow, and difficult to manage.</span>
- Solution: <span class="step">Package managers and tooling were required. Simpler methodologies were also required.</span>


### 2010+ Node Explosion

#### Node.js

In 2010, [Node.js](https://en.wikipedia.org/wiki/Node.js) began public adoption, accomplishing server-side and desktop style applications with JavaScript, notably with C style capabilities.
This unleashed JavaScript from the web browser and allowing code for the first notable time to be shared between the client and server.

``` javascript
var http = require('http'), hostname = '127.0.0.1', port = 1337
http.createServer(function (req, res) {
	res.writeHead(200, { 'Content-Type': 'text/plain' })
	res.end('Hello World\n')
}).listen(port, hostname, function () {
	console.log('Server running at http://' + hostname + ':' + port + '/');
});
```

- Problem: <span class="step">It was early days and the eco-system and capabilities had to be created from scratch.</span>
- Solution: <span class="step">More than 200,000 packages now exist for the node.js eco-system.</span>

#### NPM

In 2012, [npm](https://en.wikipedia.org/wiki/Npm_(software)) began public adoption with its bundling with [node 0.6.13](https://github.com/nodejs/node/blob/master/CHANGELOG.md#20120315-version-0613-stable), accomplishing standardised JavaScript sharing for the first time.

``` bash
mkdir multiply
npm init
echo "module.exports = function (a, b) { return a*b }" > index.js
npm publish
```

``` bash
mkdir multiplier
npm init
npm install --save multiply
echo "console.log(require('multiply')(5, 10))" > index.js
node index.js
```

- Problem: <span class="step">No path forward was yet defined for sharing isomorphic javascript code and libraries. Many techniques were developed for this (e.g. AMD, Require.js)</span>
- Solution: <span class="step">A lot of tooling and eventual standardisation was required.</span>

#### CLI Apps

#### Tooling
Browserify, Gulp, Grunt, DocPad, Yeoman, Babel, npm scripts.


### 2013+ Modern Web

#### HTML5
#### Web Sockets
#### Web RTC
#### ESNext


### 2013+ Modern Apps

#### Meteor

#### Robotics
http://johnny-five.io

#### Desktop
http://electron.atom.io

#### Virtual DOM
