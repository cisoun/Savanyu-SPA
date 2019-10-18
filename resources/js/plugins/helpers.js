//
// HELPERS
//
// Add your function overloads here.
//

/**
 * Returns true if any item of an array matches the given value.
 *
 * NOTE : Taken from C#.
 */
Array.prototype.any = function (value) {
  return this.filter(function(a) { return a == value; }).length > 0;
}

/**
 * Remove a given element from an array.
 */
Array.prototype.remove = function (item) {
  for (let i = 0; i < this.length; i++) {
    if (this[i] == item) {
      this.removeAt(i);
      return;
    }
  }
}

/**
 * Remove the nth index of an array.
 *
 * NOTE : Taken from C#.
 */
Array.prototype.removeAt = function (index) {
  if (index < this.length && index >= 0) {
    this.splice(index, 1);
  }
}

/**
 * Remove the nth index of an array.
 *
 * NOTE : Taken from C#.
 */
Array.prototype.replaceAt = function (index, item) {
  if (index < this.length && index >= 0) {
    this.splice(index, 1, item);
  }
}


/**
 * Returns a formatted string from a given array of data.
 *
 * NOTE : Taken from C#
 */
String.prototype.format = function (args) {
  let s = this;

  for (let k in args) {
    s = s.replace("{" + k + "}", args[k])
  }

  return s;
}

/**
 * Returns true if a string is null or does only contain whitespaces.
 *
 * NOTE : Taken from C#.
 */
String.prototype.isNullOrWhiteSpace = function () {
  return !(this && this.trim().length > 0);
}


export function toHTML (text) {
  return text.replace(/\r\n/g, '<br/>');
}
