'use strict';
var Animale = function(plbl = null) {
    this.lbl = plbl,
    this.pv = 20,
    this.add = function () {
        this.pv += 1;
    },
    this.sub = function () {
        this.pv -= 1;
    }
};

var cat = function () {
    Animale.apply(this,arguments) // équivalent au BASE (C#) ou SUPER (JAVA)
    this.name = "";
    this.setname = function (p) {
        this.name = p;
    };
    this.getname = function () {
        return this.name;
    }
}

var animal1 = new Animale();
console.log(animal1);

var cat1 = new cat('chat');
cat1.add();
cat1.setname("boubou");
console.log(cat1.getname());
console.log(cat1);

var cat2 = new cat();
cat2.sub();
cat2.sub();
cat2.setname("truc");
console.log(cat2.getname());
console.log(cat2);

