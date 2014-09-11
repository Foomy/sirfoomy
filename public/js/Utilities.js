
;var Utilities = {

	rand: function (min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	},

	inArray: function (needle, haystack) {
		if (haystack.indexOf(needle) >= 0) {
			return true;
		}

		return false;
	}

}