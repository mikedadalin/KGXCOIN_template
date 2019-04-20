var labels = [];
var series = [];
var high = 0;
$.ajax({
    url: "assets/class/loadRateHistory.php",
    type: "POST",
    async: false,
    data: {
        "action": 'loadRateHistory'
    },
    success: function(data) {
        var data_array = data.split('||');
        for (var i = 1; i < data_array.length; i++) {
            var temp_array = data_array[i].split('_');
            labels[i-1] = temp_array[0].replace(' ', '\n');
            series[i-1] = {meta: 'USD', value: Number(temp_array[1])};
            if (i == (data_array.length - 1)) {
                high = Number(temp_array[1]) + 0.02;
            }
        }
    }
});

var data = {
    labels: labels,
    series: [series]
};

var options = {
    axisX: {
        labelInterpolationFnc: function(value) {
            return value;
        }
    },
    low: 0,
    high: high,
    fullWidth: true,
    plugins: [
        Chartist.plugins.tooltip()
    ]
};

var responsiveOptions = [
    ['screen and (min-width: 641px) and (max-width: 1024px)', {
        //showPoint: false,
        axisX: {
            labelInterpolationFnc: function(value) {
                return value;
            }
        }
    }],
    ['screen and (max-width: 640px)', {
        //showLine: false,
        axisX: {
            labelInterpolationFnc: function(value) {
                return value;
            }
        }
    }]
];

new Chartist.Line('#kgx-chart', data, options, responsiveOptions);

var defaultOptions = {
    threshold: 0,
    classNames: {
        aboveThreshold: 'ct-threshold-above',
        belowThreshold: 'ct-threshold-below'
    },
    maskNames: {
        aboveThreshold: 'ct-threshold-mask-above',
        belowThreshold: 'ct-threshold-mask-below'
    }
};