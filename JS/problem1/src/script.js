"use strict";

var countModule = (function() {

	var countOfMultiples = 0,
		countOfOddNumbers = 0, 
		start = 0, 
		end = 0, 
		base = 0,
		outputQueue = [],
		self;

	function init(a,z,b){
		self = this;
		start = a, end = z, base = b, outputQueue = [];
		tallyOddsAndMultiples(a, z, b);
	}

	function tallyOddsAndMultiples(a, z, b){
		countOfMultiples = 0, countOfOddNumbers = 0;
		var currentNum = 0;
		for (currentNum = start; currentNum <= end; currentNum++){
			if (self.isOddNumber(currentNum)){
				countOfOddNumbers++;
			} 
			if (self.isAMultipleOfB(currentNum, base)){
				countOfMultiples++;
			}
			outputQueue.unshift(countModule.getOutput(currentNum))
		}
	}

	function display(dispFunction) {
		var i, queueLength;
		queueLength = outputQueue.length;
		for(i=0; i<queueLength; i++){
			dispFunction(outputQueue.pop());
		}
		dispFunction("Odd numbers: " + String(countOfOddNumbers));
		dispFunction( "Factor " + String(base) + ": " + String(countOfMultiples) )
	}

	return {
		isOddNumber: function(number) {
			return number % 2 === 1;		
		},
		isAMultipleOfB : function(A, B){
			return A % B === 0;
		},
		getMissingFactor: function(product, factor1) {
			return (product / factor1);
		},
		getOutput : function(number){
			var factor, output;
			if (this.isOddNumber(number)){
				output =  String(number).concat('!');
			} else {
				if (this.isAMultipleOfB(number, base)){
					factor = this.getMissingFactor(number, base);
					output = 'Sixteen times '.concat(String(factor));
				} else {
					output = String(number);
				}
				
			}
			return output;
		},
		getTallyOfOdds: function (){
			   return countOfOddNumbers;
		},
		getTallyOfMultiples: function () {
			return countOfMultiples;
		},
		display: display,
		init: init
	}

}());

var START = 1;
var END = 100;
var FACTOR = 16;

countModule.init(START, END, FACTOR)
countModule.display(console.debug);