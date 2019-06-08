;var Gallery = {

	albumCoverShiftWidth: '10px',

	init: function () {
		this.bindAlbumCover();
		this.bindThumbnails();
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
	},

	bindThumbnails: function () {
		var fadingSpeed = 700;

		$('.is_tNail').unbind('click').bind('click.showImage', function () {
			var imageId = $(this).data('id');
			var imgSrc = $('.is_tnMeta'+imageId).data('imgsrc');
//console.log(imgSrc);
			$('.is_mainview').fadeOut(fadingSpeed, function () {
				$('.is_mainview img').attr('src', imgSrc);
			});
			$('.is_mainview').fadeIn(fadingSpeed);
		});
	}
};
