var WaterfallChart = new Class({
	Implements: Options,
	
	minVal: 100000000,
	maxVal: 0,
	
	prereqs: {
		chart: {
			defaultSeriesType: 'column'
		},
		//colors: ['#2222FF', '#22FF22', '#FF2222', 'rgba(0,0,0,0)'],
		plotOptions: {
			column: {
				stacking: 'normal',
				showInLegend: false,
			}
		}

	},
	
	options: {
		yAxis: {
		},
		tooltip: {
			borderColor: '##000000',
			formatter: function() {
				var precision = (this.y < 100) ? 1 : 0;
				return Highcharts.numberFormat(this.y, precision, '.', ',');
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.025,
				groupPadding: 0,
				dataLabels: {
					formatter: function() {
						var precision = (Math.abs(this.y) < 100) ? 1 : 0;
						if (this.x && this.x < this.series.data.length-1) {
							var retval = Highcharts.numberFormat(this.y, precision, '.', ',');
							if (this.y > 0) retval = '+' + retval;
							return retval;
						} else
							return Highcharts.numberFormat(this.y, precision, '.', ',');
					}
				},
			}
		}
	},
	
	initialize: function(options) {
		this.waterfallSeries = options.series[0];
		this.waterfallCategories = options.xAxis.categories;
		
		this.setOptions(options);
		this.setOptions(this.prereqs);
		this.options.series = this.generateColumnSeries(this.waterfallSeries.data);

	  this.options.yAxis['min'] = this.minVal-0.3*(this.maxVal-this.minVal);
	  this.options.yAxis['max'] = this.maxVal+0.1*(this.maxVal-this.minVal);		
					
		this.options.plotOptions.column.dataLabels.formatter = this.createDataLabelFormatter(this.options.plotOptions.column.dataLabels.formatter);
		this.options.tooltip.formatter = this.createTooltipFormatter(this.options.tooltip.formatter);
		return new Highcharts.Chart(this.options);
	},
		
	createDataLabelFormatter: function(forwardFunction) {
		var wfs = this.waterfallSeries;
		return function() {
			if (this.series.name == 'Base') {
				this.series = wfs;
				this.y = this.series.data[this.x];
				return forwardFunction.bind(this)();
			} else return null;
		}
	},	
	
	createTooltipFormatter: function(forwardFunction) {
		var wfs = this.waterfallSeries;
		var wfc = this.waterfallCategories;
		return function() {
			var i=0;
			this.series = wfs;
			for (var i=0; i<wfc.length; i++)
				if (wfc[i] == this.x) break;
			this.y = this.series.data[i];
			this.xPos = i;
			return forwardFunction.bind(this)();
		}
	},

	generateColumnSeries: function(wf) {
		var zeroArray = function() { var arr = []; for (var i=0; i<wf.length; i++) arr.push(0); return arr };
		var series = [	{name: 'Base', data: zeroArray(), color: '#2222FF', borderColor: '#4444FF', borderWidth: 1}, 
										{name: 'Plus', data: zeroArray(), color: '#22FF22', borderColor: '#44FF44', borderWidth: 1}, 
										{name: 'Minus', data: zeroArray(), color: '#FF2222', borderColor: '#FF4444', borderWidth: 1}, 
										{name: 'Invis', data: zeroArray(), color: 'rgba(0,0,0,0)'}  ];
		var subtotal = 0;
		for (var i=0; i<wf.length; i++) {
			if (i == 0  || i == wf.length-1) {
				series[0].data[i] = wf[i];
			} else {
				if (wf[i] >= 0) {
					series[1].data[i] = wf[i];
					series[3].data[i] = subtotal;
				} else {
					series[2].data[i] = -wf[i];
					series[3].data[i] = subtotal + wf[i];
				}
			}
			subtotal += wf[i];
			if (subtotal > this.maxVal && i+1 != wf.length) this.maxVal = subtotal;
			if (subtotal < this.minVal) this.minVal = subtotal;
		}
		
		return series;
	}	
		

});