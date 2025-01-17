!function(o){"use strict";
	function e(){
		this.$body=o("body"),
		this.charts=[]
			}
		e.prototype.initCharts=function(){
			window.Apex={
				chart:{
					parentHeightOffset:0,toolbar:{
						show:!1}
					},
				grid:{
					padding:{
						left:0,
						right:0
						}
					},
				colors:["#727cf5","#0acf97","#fa5c7c","#ffbc00"]
			};
		var e=["#727cf5","#0acf97","#fa5c7c","#ffbc00"],
			t=o("#revenue-chart").data("colors");
			t&&(e=t.split(","));
		var r={
			chart:{
				height:364,
				type:"line",
				dropShadow:{
					enabled:!0,
					opacity:.2,
					blur:7,
					left:-7,
					top:7
					}
				},
			dataLabels:{
				enabled:!1
				},
			stroke:{
				curve:"smooth",
				width:4
				},
			series:[{
				name:"Current Week",
				data:[10,20,15,25,20,30,20]
				},{
				name:"Previous Week",
				data:[0,15,10,30,15,35,25]
				}],
			colors:e,
			zoom:{
				enabled:!1
				},
			legend:{
				show:!1
				},
			xaxis:{
				type:"string",
				categories:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],
				tooltip:{
					enabled:!1
					},
				axisBorder:{
					show:!1
					}
				},
			yaxis:{
				labels:{
					formatter:function(e){return e+"k"},
					offsetX:-15
					}
				}
			};
		new ApexCharts(document.querySelector("#revenue-chart"),r).render();
		},
			e.prototype.init=function(){
				o("#dash-daterange").daterangepicker({
					singleDatePicker:!0
					}),
					this.initCharts(),
					this.initMaps()
				},
				o.Dashboard=new e,
				o.Dashboard.Constructor=e
	}(window.jQuery),
function(t){"use strict";
	t(document).ready(function(e){
		t.Dashboard.init()
		})
	}(window.jQuery);