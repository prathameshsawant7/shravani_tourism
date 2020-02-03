$(document).ready(function() 
{
    var iSeller_id  = $("#iSeller_id").val();
    $.post("../ajax_call.php",{request:'getSellerDetails',iSeller_id:iSeller_id},function(data) 
    {
        var graph = {};
        var disp_data = JSON.parse(data);
        var details = [
		{
			title: 'Total Products',
			value: disp_data['products'],
			color: '#91D6BC'
		},
		{
			title: 'Total Sales',
			value: "₹ "+disp_data['sales'],
			color: '#768C6A'
		}];
        
        var graph = {

		init:  function(data, title){
			$('#graph_holder').empty();
			this.values = data;
			var $bar;
			var options;
			var dataLen = this.values.length;
			var padding = 7;
			this.holderHeight = $('#graph_holder').height()-200;
			this.holderWidth = $('#graph_holder').width();
			var barHeight = parseInt(this.holderHeight/dataLen);
			var width;
			var minWidth = 250;
			var max = this.max();

			this.backgroundTitle(title);

			for(var i=0; i<dataLen; i++){
				options = this.values[i];
				width = 500;//(this.holderWidth - minWidth - 20) * options.value / max;
                                //alert(width);
				$bar = $('<div />').css({ 
										height: barHeight - padding + 'px', 
										'line-height': barHeight - padding + 'px',
										'font-size': barHeight - padding - 5 + "px",
										top: barHeight * i, 
										'background-color': options.color, 
										width: width + minWidth,
										left: -width - minWidth + 'px'
									})
									.animate({
										left: 0
									}, 1000)
									.append( $('<div />').html(options.title).addClass('v_bar_title') )
									.append( $('<div />').html(options.value).addClass('v_bar_value').css('font-size', barHeight - padding + "px") )
									.addClass('v_bar')
									.appendTo($('#graph_holder'));
			}
		},

		backgroundTitle: function(text){
			$('<div />').html(text)
						.css({ 'font-size': this.holderHeight/1.5 + 'px', 'line-height': this.holderHeight/2 + 'px', 'width': this.holderWidth })
						.addClass('bg_text')
						.appendTo($('#graph_holder'));
		},

		/**
		 * Find maximum value from graph data 
		 * @return number
		 */
		max: function(){
			var max = 0;
			for( var i in this.values ){
				if (this.values[i].value > max){
					max = this.values[i].value;
				}
			}
			return max;
		}
	};
        graph.init(details, '');
        $("#graph_holder").css('height','80px');
        //graph.init(values1, '');
    });
    
    
    
    
});

