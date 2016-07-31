

//Flot Pie Chart
$(function() {

	

    var data = [{
        label: "In Progress",
        data: 15
    }, {
        label: "Incomplete",
        data: 18
    }, {
        label: "Delayed",
        data: 9
    }, {
        label: "",
        data: 0
    }];

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});

