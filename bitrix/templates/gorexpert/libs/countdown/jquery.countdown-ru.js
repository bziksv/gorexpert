/* http://keith-wood.name/countdown.html
 * Russian initialisation for the jQuery countdown extension
 * Written by Sergey K. (xslade{at}gmail.com) June 2010. */
(function($) {
        $.countdown.regionalOptions['ru'] = {
		labels: ['Р›РµС‚', 'РњРµСЃСЏС†РµРІ', 'РќРµРґРµР»СЊ', 'Р”РЅРµР№', 'Р§Р°СЃРѕРІ', 'РњРёРЅСѓС‚', 'РЎРµРєСѓРЅРґ'],
		labels1: ['Р“РѕРґ', 'РњРµСЃСЏС†', 'РќРµРґРµР»СЏ', 'Р”РµРЅСЊ', 'Р§Р°СЃ', 'РњРёРЅСѓС‚Р°', 'РЎРµРєСѓРЅРґР°'],
		labels2: ['Р“РѕРґР°', 'РњРµСЃСЏС†Р°', 'РќРµРґРµР»Рё', 'Р”РЅСЏ', 'Р§Р°СЃР°', 'РњРёРЅСѓС‚С‹', 'РЎРµРєСѓРЅРґС‹'],
		compactLabels: ['Р»', 'Рј', 'РЅ', 'Рґ'], compactLabels1: ['Рі', 'Рј', 'РЅ', 'Рґ'],
		whichLabels: function(amount) {
			var units = amount % 10;
			var tens = Math.floor((amount % 100) / 10);
			return (amount == 1 ? 1 : (units >= 2 && units <= 4 && tens != 1 ? 2 :
				(units == 1 && tens != 1 ? 1 : 0)));
		},
		digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regionalOptions['ru']);
})(jQuery);