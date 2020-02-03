/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Metrics
*/ 

pieCounter = 1;
$(document).ready(function() 
{
    var iSeller_id  = $("#iSeller_id").val();
    
    $("#cSellerlist").change(function()
    {
        window.location.href="orders.php?iSeller_id="+$('#cSellerlist').val();
    });

    $('#cSellerlist option[value="'+trim($("#iSeller_id").val())+'"]').prop('selected', true);
    
    
    
    $.post("ajax_call.php",{request:'getTotalSalesTrack',iSeller_id:iSeller_id},function(data) 
    {
        dataArray = data.split('_');
        
        if(trim(dataArray[0]) == '')
            dataArray[0] = 0;
        if(trim(dataArray[1]) == '')
            dataArray[1] = 0;
        if(trim(dataArray[2]) == '')
            dataArray[2] = 0;
        
        
        createPie(dataArray[0],dataArray[1],dataArray[2]);
        
        if(dataArray[0]== 0 && dataArray[1] == 0 && dataArray[2] == 0)
            $('#cSalesPie').hide();
        
        $('#img_Loading_pie').hide();
        
        
    });
    
    $.post("ajax_call.php",{request:'getSalesByMonth',iSeller_id:iSeller_id},function(data) 
    {

        var obj = $.parseJSON(data);

        var chart1 = new Chartist.Line('#cSalesChart', {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
              [Math.round(obj['Jan']),Math.round(obj['Feb']),Math.round(obj['Mar']),Math.round(obj['Apr']),Math.round(obj['May']),Math.round(obj['Jun']),Math.round(obj['Jul']),Math.round(obj['Aug']),Math.round(obj['Sep']),Math.round(obj['Oct']),Math.round(obj['Nov']),Math.round(obj['Dec'])]
            ]
          }, {
            low: 0
          });

        createChart(chart1);
        $('#img_Loading_chart').hide();
        html = '<table style="font-size:12px;"><tbody><tr><td><b><center>Month</center></b></td><td><b>Sale</b></td></tr>';

        cRecords = 0;
        for(key in obj)
        {
            if(obj[key] != 0)
            {
                html = html + '<tr><th><b><center>'+key+'</center></b></th><td>Worth Rs. '+obj[key]+'</td></tr>';
                cRecords++;
            }
        }
        if(cRecords == 0)
            html = html + '<tr><th colspan="2"><b><center>No Records Found</center></b></td></tr>';

        html = html + '</tbody></html>';

        $('#totalYearSale').html(html);

    });
    
    $.post("ajax_call.php",{request:'getTop10',iSeller_id:iSeller_id},function(data) 
    {
        $('#top10').html(data);
    });
    
    $.post("ajax_call.php",{request:'getTop3',iSeller_id:iSeller_id},function(data) 
    {
        
        var obj = $.parseJSON(data);
        $('#top3').html(obj['tableData']);
        
        var MONTHS = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var $progress = $('#animationProgress');

        var config = {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: []
            },
            options: {
                title:{
                    display:true,
                    text:"Month wise Sell of top 3 products of this year "
                },
                animation: {
                    duration: 2000,
                    onProgress: function(animation) {
                        $progress.attr({
                            value: animation.animationObject.currentStep / animation.animationObject.numSteps,
                        });
                    },
                    onComplete: function(animation) {
                        window.setTimeout(function() {
                            $progress.attr({
                                value: 0
                                });
                            }, 2000);
                        }
                    },
                    tooltips: {
                        mode: 'label',
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                show: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                show: true,
                                labelString: 'Value'
                            },
                        }]
                    }
                }
            };
        
            $.each(config.data.datasets, function(i, dataset) {
            dataset.borderColor = randomColor(0.4);
            dataset.backgroundColor = randomColor(0.5);
            dataset.pointBorderColor = randomColor(0.7);
            dataset.pointBackgroundColor = randomColor(0.5);
            dataset.pointBorderWidth = 1;
            });

            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
            
            
            for(i=0;i<obj['countData'];i++)
            {
                var recordString = obj['graphData'][i]['Jan']+','+obj['graphData'][i]['Feb']+','+obj['graphData'][i]['Mar']+','+obj['graphData'][i]['Apr']+','+obj['graphData'][i]['May']+','+obj['graphData'][i]['Jun']+','+obj['graphData'][i]['Jul']+','+obj['graphData'][i]['Aug']+','+obj['graphData'][i]['Sep']+','+obj['graphData'][i]['Oct']+','+obj['graphData'][i]['Nov']+','+obj['graphData'][i]['Dec'];
                
                 var newDataset = {
                    label: obj['productData'][i],
                    borderColor: randomColor(0.4),
                    backgroundColor: randomColor(0.5),
                    pointBorderColor: randomColor(0.7),
                    pointBackgroundColor: randomColor(0.5),
                    pointBorderWidth: 1,
                    data: [],
                };

                recordArray = recordString.split(',');
                for (var index = 0; index < config.data.labels.length; ++index) 
                {
                    newDataset.data.push(recordArray[index]);
                }

                config.data.datasets.push(newDataset);
                window.myLine.update();
                
                
            }
        
            
    });
    
});

var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };


function addRecordTop3(name,recordString)
{
    
   
}


function createChart(chart)
{
    // Let's put a sequence number aside so we can use it in the event callbacks
    var seq = 0,
      delays = 30,
      durations = 500;

    // Once the chart is fully created we reset the sequence
    chart.on('created', function() {
      seq = 0;
    });

    // On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
    chart.on('draw', function(data) {
      seq++;

      if(data.type === 'line') {
        // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
        data.element.animate({
          opacity: {
            // The delay when we like to start the animation
            begin: seq * delays + 1000,
            // Duration of the animation
            dur: durations,
            // The value where the animation should start
            from: 0,
            // The value where it should end
            to: 1
          }
        });
      } else if(data.type === 'label' && data.axis === 'x') {
        data.element.animate({
          y: {
            begin: seq * delays,
            dur: durations,
            from: data.y + 100,
            to: data.y,
            // We can specify an easing function from Chartist.Svg.Easing
            easing: 'easeOutQuart'
          }
        });
      } else if(data.type === 'label' && data.axis === 'y') {
        data.element.animate({
          x: {
            begin: seq * delays,
            dur: durations,
            from: data.x - 100,
            to: data.x,
            easing: 'easeOutQuart'
          }
        });
      } else if(data.type === 'point') {
        data.element.animate({
          x1: {
            begin: seq * delays,
            dur: durations,
            from: data.x - 10,
            to: data.x,
            easing: 'easeOutQuart'
          },
          x2: {
            begin: seq * delays,
            dur: durations,
            from: data.x - 10,
            to: data.x,
            easing: 'easeOutQuart'
          },
          opacity: {
            begin: seq * delays,
            dur: durations,
            from: 0,
            to: 1,
            easing: 'easeOutQuart'
          }
        });
      } else if(data.type === 'grid') {
        // Using data.axis we get x or y which we can use to construct our animation definition objects
        var pos1Animation = {
          begin: seq * delays,
          dur: durations,
          from: data[data.axis.units.pos + '1'] - 30,
          to: data[data.axis.units.pos + '1'],
          easing: 'easeOutQuart'
        };

        var pos2Animation = {
          begin: seq * delays,
          dur: durations,
          from: data[data.axis.units.pos + '2'] - 100,
          to: data[data.axis.units.pos + '2'],
          easing: 'easeOutQuart'
        };

        var animations = {};
        animations[data.axis.units.pos + '1'] = pos1Animation;
        animations[data.axis.units.pos + '2'] = pos2Animation;
        animations['opacity'] = {
          begin: seq * delays,
          dur: durations,
          from: 0,
          to: 1,
          easing: 'easeOutQuart'
        };

        data.element.animate(animations);
      }
    });

    // For the sake of the example we update the chart every time it's created with a delay of 10 seconds
    chart.on('created', function() {
      if(window.__exampleAnimateTimeout) {
        clearTimeout(window.__exampleAnimateTimeout);
        window.__exampleAnimateTimeout = null;
      }
      window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 12000);
    });
}


function createPie(Sold,Returned,Cancelled)
{
  
    var data = {
        series: [Math.round(Sold),Math.round(Returned),Math.round(Cancelled)]
      };
    
    var sum = function(a, b) { return a + b };

    new Chartist.Pie('#cSalesPie', data, {
    labelInterpolationFnc: function(value) 
    {
        if(value != 0)
            percent = parseFloat(value / data.series.reduce(sum) * 100).toFixed(2);
        else
            percent = 0;
        
        if(pieCounter == 1)
            Worth = Sold;
        else if(pieCounter == 2)
            Worth = Returned;
        else if(pieCounter == 3)
            Worth = Cancelled;
        
        $('#pie'+pieCounter).html(percent+ '%');
        $('#pieWorth'+pieCounter).html('Worth Rs. '+Worth);
        
        pieCounter++;
        
        
        if(percent != 0)
            return percent+ '%';
    }
    });
       
}
function trim(str)
{
 return str.replace(/^\s+|\s+$/g,"");
}