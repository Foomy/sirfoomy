;var Gallery = {

	albumCoverShiftWidth: '10px',

	init: function () {
		this.bindAlbumCover();
	},

	bindAlbumCover: function () {
		$('.is_gallery').bind('mouseover.shift', function () {
			var galId = $(this).data('galid');

			$('.is_rotLeft'+galId).css('left', Gallery.albumCoverShiftWidth);
			$('.is_rotRight'+galId).css('left', '-'+Gallery.albumCoverShiftWidth);
		});

		$('.is_gallery').bind('mouseout.shift', function () {
			var galId = $(this).data('galid');

			$('.is_rotLeft'+galId).css('left', '0px');
			$('.is_rotRight'+galId).css('left', '0px');
		});
	}
};
