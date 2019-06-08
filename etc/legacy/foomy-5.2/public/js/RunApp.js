;var RunApp = {

	init: function () {
		this.equilizeColums();

		if (typeof Gallery !== 'undefined') {
			Gallery.init();
		}

		if (typeof Lotto !== 'undefined') {
			Lotto.init();
		}
	},

	equilizeColums: function () {
		var $content = $('.is_content'),
			$aside = $('aside');

		if ($content.height() > $aside.height()) {
			$aside.height($content.height());
		}
		else {
			$content.css('min-height', $aside.height());
		}
	}
};

jQuery(document).ready(function() {
	RunApp.init();
});