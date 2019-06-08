;
var Lotto = {

	init: function () {
		this.resetCheckboxes();
		this.resetNumCountField();

		this.bindNumberClick();
		this.bindSubmitButton();
		this.bindResetButton();
		this.bindRandomButton();
		this.bindNumCountField();
	},

	resetCheckboxes: function () {
		$('.is_cb').prop('checked', false);
		$('.is_selectCross').addClass('hidden');
	},

	resetNumCountField: function () {
		$('.is_numCount').val('');
	},

	bindNumberClick: function () {
		$('.is_number').unbind('click').bind('click.check', function () {
			var number = $(this).data('num');

			if ($('.is_cb' + number + ':checked').length > 0) {
				Lotto.uncheckNumber(number);
			}
			else {
				Lotto.checkNumber(number);
			}
		});
	},

	checkNumber: function (number) {
		$('.is_cb' + number).prop('checked', true);
		$('.is_selectCross_' + number).removeClass('hidden');
	},

	uncheckNumber: function (number) {
		$('.is_cb' + number).prop('checked', false);
		$('.is_selectCross_' + number).addClass('hidden');
	},

	bindSubmitButton: function () {
		$('.is_submitBtn').unbind('click').bind('click.submit', function () {
			var numbers = new Array();
			var request;

			if ($('.is_cb:checked').length < 6) {
				alert('Sie müssen mind. 6 Zahlen ankreuzen.');
				return false;
			}

			$('.is_cb:checked').each(function () {
				numbers.push($(this).val());
			});

			request = $.ajax({
				url: '/lotto/generate-combinations/',
				type: 'post',
				data: {
					numbers: numbers
				},
				dataType: 'json',
				beforeSend: function () {
					$('.is_output').html('');
					$('.is_spinner').removeClass('hidden');
				},
				success: function (response) {
					var sixpack, combostring;

					$('.is_spinner').addClass('hidden');

					for (i=0; i<420; i++) {
						sixpack = response.combinations[i];

						combostring = '';
						for (j=0; j<6; j++) {
							combostring += sixpack[j];

							if (j < 5) {
								combostring += ',';
							}
						}
						combostring += '<br>';

						$('.is_output').append(combostring);
					}
				}
			});
		});
	},

	bindResetButton: function () {
		$('.is_resetBtn').unbind('click').bind('click.reset', function () {
			Lotto.resetCheckboxes();
			Lotto.resetNumCountField();
		});
	},

	bindRandomButton: function () {
		$('.is_randomBtn').unbind('click').bind('click.rand', function () {
			$('.is_numCount').toggle();
		});
	},

	bindNumCountField: function () {
		$('.is_numCount').unbind('keyup').bind('keyup.getval', function () {
			var numCount = $(this).val();

			window.setTimeout(function () {
				var number,
					lastNumbers = [];

				if (numCount < 6 || numCount > 49) {
					return;
				}

				Lotto.resetCheckboxes();

				while (lastNumbers.length < numCount) {
					number = Utilities.rand(1, 49);

					if (!Utilities.inArray(number, lastNumbers)) {
						lastNumbers.push(number);
					}
				}

//				lastNumbers.sort(function Numsort(a, b) {
//					return a - b;
//				});
//console.log(lastNumbers.length);
//console.log(lastNumbers);
//console.log('');

				for (i = 0; i < lastNumbers.length; i++) {
					Lotto.checkNumber(lastNumbers[i]);
				}
			}, 1000);
		});
	}


};
