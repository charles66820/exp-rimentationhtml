/**
* Text.
*
* @param {string} [title] The title of the task
* @param {number} id The id of the model to update
* @param {object} data The properties to update and their new value
* @param {function} [callback] The callback to fire after the model is created
*/
Model.prototype.create = function (title, callback) {
  title = title || '';
  callback = callback || function () {};

  this.testv = title;
};

'use strict';
var Model = function(v) {
    this.testv = v,
    this.create = function (title) {
        title = title || '';
        this.testv = title;
    },

	this.update = function (id, data) {
		this.testv = id+data;
	},

	this.remove = function (id) {
		this.testv = id;
	}
};

var firsttest = new Model("truc");
console.log(firsttest);
//============================================================
'use strict';
var Animale = function() {
    this.pv = 20,

	this.add = function () {
		this.pv += 1;
	},

	this.sub = function () {
		this.pv -= 1;
	}
};

var cat = function () {
    Animale.apply(this,arguments)
    this.name = "";
    this.setname = function (p) {
        this.name = p;
    };
    this.getname = function () {
        return this.name;
    }
}

var secondetest = new Animale();
console.log(secondetest);

var firsttest = new cat();
firsttest.add();
firsttest.setname("boubou");
console.log(firsttest.getname());
console.log(firsttest);

var firsttest = new cat();
firsttest.sub();
firsttest.sub();
firsttest.setname("truc");
console.log(firsttest.getname());
console.log(firsttest);

var zetest = new Animale();
zetest.sub();
zetest.sub();
console.log(zetest);
