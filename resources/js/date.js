$(function() {
    $('#from').datepick({
    	dateFormat: 'dd-mm-yyyy',
		minDate: 0,
		maxDate: '+1y',
		changeMonth: true,
		onSelect: customRange,
        defaultDate: '0',
        selectDefaultDate: true
    });
    $('#to').datepick({
        dateFormat: 'dd-mm-yyyy',
        minDate: 0,
        maxDate: '+1y',
        changeMonth: true,
        onSelect: customRange,
        defaultDate: '1',
        selectDefaultDate: true
    });

    $('#inline').datepick({
        monthsToShow: 2,
        showOtherMonths: true,
        firstDay: 1,
        renderer: $.datepick.weekOfYearRenderer,
        onShow: $.datepick.showStatus

    })
	
});

function customRange(dates) {
	var start = $('#from').datepick('getDate')[0];
    var end = $('#to').datepick('getDate')[0];
    var total = start && end ? (end.getTime() - start.getTime()) / 1000 / 60 / 60 / 24 : '';
	
	if (this.id == 'from') {
		$('#to').datepick('option', 'minDate', dates[0] || null);
		$( "#listRender" ).datepick( "option", "minDate", dates[0] || null);
	}
	else {
		$('#from').datepick('option', 'maxDate', dates[0] || null);
		$( "#listRender" ).datepick( "option", "maxDate", dates[0] || null);
		
	}
	$('#total_days').val(total);
	
}

function calculator() {
	var quantity = $('#quantity option:selected').html();

	$('#quantity').on('change', function () {
	  alert($(quantity).val());
	  alert($(quantity).text());
	});

}
