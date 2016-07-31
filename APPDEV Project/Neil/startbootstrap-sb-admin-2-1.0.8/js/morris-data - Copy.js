$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2014 Q1',
            metal: 5200,
          
        }, {
            period: '2014 Q2',
            metal: 5239,
            
        }, {
            period: '2014 Q3',
           metal: 5500,
            
        }, {
            period: '2014 Q4',
            metal: 2345,
           
        }, {
            period: '2015 Q1',
            metal: 3000,
           
        }, {
            period: '2015 Q2',
           metal: 3200,
           
        }, {
            period: '2015 Q3',
          metal: 3100,
         
        }, {
            period: '2015 Q4',
            metal: 3000,
           
        }, {
            period: '2016 Q1',
           metal: 2000,
           
        }, {
            period: '2016 Q2',
           metal: 3000,
            
        }],
        xkey: 'period',
        ykeys: ['metal'],
        labels: ['Metal'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

	
	
    Morris.Area({
        element: 'morris-area-chart2',
        data: [{
            period: '2014 Q1',
         
            wood: 4300,
           
        }, {
            period: '2014 Q2',
            
            wood: 4295,
           
        }, {
            period: '2014 Q3',
          
            wood: 4000,
          
        }, {
            period: '2014 Q4',
           
            wood: 4200,
           
        }, {
            period: '2015 Q1',

            wood: 4800,
            
        }, {
            period: '2015 Q2',
         
            wood: 4500,
           
        }, {
            period: '2015 Q3',
         
            wood: 4300,
           
        }, {
            period: '2015 Q4',
           
            wood: 4200,
           
        }, {
            period: '2016 Q1',
         
            wood: 2800,
           
        }, {
            period: '2016 Q2',
         
            wood: 1000,
            
        }],
        xkey: 'period',
        ykeys: ['wood'],
        labels: ['Wood'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
	
	Morris.Area({
        element: 'morris-area-chart3',
        data: [{
            period: '2014 Q1',
          
            concrete: 800
        }, {
            period: '2014 Q2',
          
            concrete: 2647
        }, {
            period: '2014 Q3',
           
            concrete: 2300
        }, {
            period: '2014 Q4',
           
            concrete: 2638
        }, {
            period: '2015 Q1',
           
            concrete: 5000
        }, {
            period: '2015 Q2',
           
            concrete: 5300	
        }, {
            period: '2015 Q3',
        
            concrete: 5000
        }, {
            period: '2015 Q4',
           
            concrete: 400
        }, {
            period: '2016 Q1',
          
            
            concrete: 1500
        }, {
            period: '2016 Q2',
          
            concrete: 2647
        }],
        xkey: 'period',
        ykeys: [ 'concrete'],
        labels: ['Concrete'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
   

    
});


