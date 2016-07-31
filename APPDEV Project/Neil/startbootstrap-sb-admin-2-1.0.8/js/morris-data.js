$(function() {


    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'XYG 324',
            a: 15000000,
            b: 17000000
        }, {
            y: 'ZNB 325',
            a: 13000000,
            b: 15000000
        }, {
            y: 'AWR 326',
            a: 12000000,
            b: 14000000
        }, {
            y: 'AAA 337',
            a: 16000000,
            b: 15004130
        }, {
            y: 'BBB 338',
                       a: 12000000,
            b: 14000000
        }, {
            y: 'CCC 339',
                      a: 12012340,
            b: 14000000
        }, {
            y: 'DDD 340',
                       a: 12230000,
            b: 14002030
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Forecasted Project Price', 'Actual Project Price'],
        hideHover: 'auto',
        resize: true
    });
	
	
	Morris.Bar({
        element: 'morris-bar-chart2',
        data: [{
            y: 'XYX 324',
            a: 15040800,
            b: 17000000
        }, {
            y: 'ZNB 325',
            a: 13000000,
            b: 15000000
        }, {
            y: 'AWR 326',
            a: 12000000,
            b: 14000000
        }, {
            y: 'AAA 337',
            a: 16000000,
            b: 15004130
        }, {
            y: 'BBB 338',
                       a: 12000000,
            b: 14000000
        }, {
            y: 'CCC 339',
                      a: 12012340,
            b: 14000000
        }, {
            y: 'DDD 340',
                       a: 12230000,
            b: 14002030
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Forecasted Project Price', 'Actual Project Price'],
        hideHover: 'auto',
        resize: true
    });
	
	
	
	
	
	
   

    
});


