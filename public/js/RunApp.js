var RunApp = {

	equiliseColums: function () {
		var $content = $('.is_content'),
			$aside = $('aside');

		if ($content.height() > $aside.height()) {
			$aside.height($content.height());
		}
		else {
			$content.height($aside.height());
		}
	}
};

jQuery(document).ready(function() {
	RunApp.equiliseColums();
});