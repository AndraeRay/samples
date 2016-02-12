describe("This module displays special text as it iterates over numbers,", function() {


  beforeEach(function() {
    start = 1, end = 20, factor = 16;
    countModule.init(start, end, factor);

  });

  it('defines a counting object define', function(){
    expect(countModule).toBeDefined();
  })
;
  it('should identify odd numbers', function() {
    var num = 5;
    expect(countModule.isOddNumber(num)).toBe(true);

    var num = 8;
    expect(countModule.isOddNumber(num)).toBe(false);

  });

  it("should return odd numbers followed by !", function() {
    var num = 19;
    expect(countModule.getOutput(num)).toBe("19!")

    var num = 1;
    expect(countModule.getOutput(num)).toBe("1!")

  });

  it("should display even numbers normally if not a multiple of 16", function() {
    var num = 18;
    expect(countModule.getOutput(num)).toBe("18")
  });

  it('should identify multiples of 16', function() {
    var num = 15;
    expect(countModule.isAMultipleOfB(num, 16)).toBe(false);   

    var num = 16;
    expect(countModule.isAMultipleOfB(num, 16)).toBe(true); 

    var num = 31;
    expect(countModule.isAMultipleOfB(num, 16)).toBe(false);

    var num = 32;
    expect(countModule.isAMultipleOfB(num, 16)).toBe(true);

  });

  it('should return x where 16 times x equals y', function() {
    var num = 32;
    expect(countModule.getMissingFactor(num, 16)).toBe(2);

    var num = 64;
    expect(countModule.getMissingFactor(num, 16)).toBe(4);

  });

  it("should output multiple of 16 as 'Sixteen times factor' ", function() {
    var num = 16;
    expect(countModule.getOutput(num)).toBe("Sixteen times 1");

    var num = 32;
    expect(countModule.getOutput(num)).toBe("Sixteen times 2");

    var num = 64;
    expect(countModule.getOutput(num)).toBe("Sixteen times 4");
  });

  it('should count all odd numbers between start and end', function() {
    var start = 1, end = 1;
    countModule.init(start, end);
    expect(countModule.getTallyOfOdds()).toBe(1);

    var start = 2, end = 2;
    countModule.init(start, end);
    expect(countModule.getTallyOfOdds()).toBe(0);

    var start = 1, end = 5;
    countModule.init(start, end);
    expect(countModule.getTallyOfOdds()).toBe(3);

    var start = 1, end = 20;
    countModule.init(start, end);
    expect(countModule.getTallyOfOdds()).toBe(10);

  });

  it('should tally multiples of 16 between start and end', function() {
    var start = 1, end = 1, factor = 16;
    countModule.init(start, end, factor);
    expect(countModule.getTallyOfMultiples()).toBe(0);

    var start = 2, end = 31, factor = 16;
    countModule.init(start, end, factor);
    expect(countModule.getTallyOfMultiples()).toBe(1);

    var start = 1, end = 65, factor = 16;
    countModule.init(start, end, factor);
    expect(countModule.getTallyOfMultiples()).toBe(4);

  });


  
});
