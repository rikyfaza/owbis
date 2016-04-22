var labelType, useGradients, nativeTextSupport, animate;

var dataranges = null;

(function() {
  var ua = navigator.userAgent,
      iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
      typeOfCanvas = typeof HTMLCanvasElement,
      nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
      textSupport = nativeCanvasSupport 
        && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
  //I'm setting this based on the fact that ExCanvas provides text support for IE
  //and that as of today iPhone/iPad current text support is lame
  labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
  nativeTextSupport = labelType == 'Native';
  useGradients = nativeCanvasSupport;
  animate = !(iStuff || !nativeCanvasSupport);
})();

var Log = {
  elem: false,
  write: function(text){
    if (!this.elem) 
      this.elem = document.getElementById('log');
    this.elem.innerHTML = text;
    this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
  }
};
	
function init(){
    //init data
	var json = (function () {
		var json = null;
		$.ajax({ 
			'async': false,
			'global': false,
			'url': '/index.php/maincontroller/gethirarkikpi/'+idviewh+'/'+idperiodname+'/'+yearname,
			//'url': '/performance_is/index.php/maincontroller/gethirarkikpi/'+idviewh+'/'+idperiodname+'/'+yearname,
			'dataType': "json",
			'success': function (data) {
				json = data;
			}
		});
		return json;
	})(); 
	
	
    //end
    //init Spacetree
    //Create a new ST instance
	
			
     st = new $jit.ST({
	
        //id of viz container element
		// subtreeOffset: 1,
		//siblingOFfset: 5,
		//multitree: true,
		height: 800,
	
		orientation: 'top',
        injectInto: 'infovis',
        //set duration for the animation
        duration: 250,
        //set animation transition type
        transition: $jit.Trans.Quart.easeInOut,
        //set distance between node and its children
        levelDistance: 25,
        //enable panning
        Navigation: {
          enable:true,
          panning:true
        },
        //set node and edge styles
        //set overridable=true for styling individual
        //nodes or edges
		offsetX: 0, offsetY: 270,
        Node: {
            height: 125,
            width: 140,
			lineWidth: 3,
            type: 'rectangle',
            color: '#aaa',
            overridable: true
        },
        
        Edge: {
            type: 'bezier',
            overridable: true,
			lineWidth: 2,
			color: '#3B5998'
        },
        
        onBeforeCompute: function(node){
            //Log.write("loding " + node.name);
			//console.log(node.data.type);
			//var iddb = '123';
			$.ajax({
				'async': false,
				'global': false,
				'url': '/index.php/maincontroller/gettblranges/'+iddb,
				//'url': '/performance_is/index.php/maincontroller/gettblranges/'+iddb,
				'dataType': "json",
				'success': function (data) {
					dataranges = data;
				}
			});
			
        },
        
        onAfterCompute: function(){
            //Log.write("done");
			//console.log('aftercom');
			
			function drawChart(chartSWF, strXML, chartdiv) {
				//Create another instance of the chart.
				var chart = new FusionCharts(chartSWF, "chart1Id", "550", "320", "0"); 
				chart.setDataXML(strXML);
				chart.render(chartdiv);
			}	
			
			
			$(".openpenugasan").off('click')
			$(".openpenugasan").on('click', (function (event){ 
				
				$.get('/index.php/maincontroller/getdatachartxy/'+idviewh+'/'+this.id, function(data) {
					drawChart("http://performance_is.net/libs/js/Charts/FCF_MSLine.swf", data, "chart1div");
				});
				
				$.get('/index.php/maincontroller/getdatachartxy/'+idviewh+'/'+this.id, function(data) {
					drawChart("http://performance_is.net/libs/js/Charts/FCF_MSLine.swf", data, "chart2div");
				});
				
				var monthperiods = null;
				$.ajax({
					'async': false,
					'global': false,
					'url': '/index.php/maincontroller/getinfomonthperiod/',
					//'url': '/performance_is/index.php/maincontroller/getinfomonthperiod/',
					'dataType': "json",
					'success': function (data) {
						console.log(monthperiods);
						monthperiods = data;
					}
				});
				
				var activeperiod = monthperiods.month;
				//console.log(activeperiod);

				var jenisform = null;
				$.ajax({
					'async': false,
					'global': false,
					'url': '/index.php/maincontroller/getinfomeasure/'+this.id,
					//'url': '/performance_is/index.php/maincontroller/getinfomeasure/'+this.id,
					'dataType': "json",
					'success': function (data) {
						jenisform = data;
					}
				});
				
				if(jenisform.type == 'group' || jenisform.type == 'formula') {
					alert('No data entry for measure type group');
					return false;
				}
				
				//console.log(jenisform.storageperiod);
				
				if(jenisform.storageperiod=='month')
				{
				
					$("#idmeasure").val(this.id);
					$("#idmeasureactcomm").val(this.id);
					$("#idview").val(idviewh);
					$("#periodmonth").dialog ("open"); 
					
					/* mengambil data action plan dan comment dan menampilkannya pada form period month */
					var dataactcomm = null;
					$.ajax({
						'async': false,
						'global': false,
						//'url': '/performance_is/index.php/maincontroller/getactcomm/'+iddb+'/'+this.id,
						'url': '/index.php/maincontroller/getactcomm/'+iddb+'/'+this.id,
						'dataType': "json",
						'success': function (data) {
							dataactcomm = data;
						}
					});
					//console.log(dataactcomm);
					if(dataactcomm == null){} else {
						$("#comments").val(dataactcomm.commentary);
						$("#actionplans").val(dataactcomm.actionplan);
					}
					
					if(activeperiod=='Jan'){ var periodnamearr = ["jan"]; }
					if(activeperiod=='Feb'){ var periodnamearr = ["jan","feb"]; }
					if(activeperiod=='Mar'){ var periodnamearr = ["jan","feb","mar"]; }
					if(activeperiod=='Apr'){ var periodnamearr = ["jan","feb","mar","apr"]; }
					if(activeperiod=='May'){ var periodnamearr = ["jan","feb","mar","apr","mei"]; }
					if(activeperiod=='Jun'){ var periodnamearr = ["jan","feb","mar","apr","mei","jun"]; }
					if(activeperiod=='Jul'){ var periodnamearr = ["jan","feb","mar","apr","mei","jun","jul"]; }
					if(activeperiod=='Aug'){ var periodnamearr = ["jan","feb","mar","apr","mei","jun","jul","aug",]; }
					if(activeperiod=='Sep'){ var periodnamearr = ["jan","feb","mar","apr","mei","jun","jul","aug","sep"]; }
					if(activeperiod=='Oct'){ var periodnamearr = ["jan","feb","mar","apr","mei","jun","jul","aug","sep","okt"]; }
					if(activeperiod=='Nov'){ var periodnamearr = ["jan","feb","mar","apr","mei","jun","jul","aug","sep","okt","nop"]; }
					if(activeperiod=='Dec'){ var periodnamearr = ["jan","feb","mar","apr","mei","jun","jul","aug","sep","okt","nop","des"]; }

					 
					 /**
					 *	get series for spesific measure, does it have or not
					 */
					var dataseries1 = null;
					var dataseries2 = null;
					$.ajax({
						'async': false,
						'global': false,
						'url': '/index.php/maincontroller/getseries/'+iddb+'/'+this.id+'/ser1',
						//'url': '/performance_is/index.php/maincontroller/getseries/'+iddb+'/'+this.id+'/ser1',
						'dataType': "json",
						'success': function (data) {
							dataseries1 = data;
						}
					});
					$.ajax({
						'async': false,
						'global': false,
						'url': '/index.php/maincontroller/getseries/'+iddb+'/'+this.id+'/ser2',
						//'url': '/performance_is/index.php/maincontroller/getseries/'+iddb+'/'+this.id+'/ser1',
						'dataType': "json",
						'success': function (data) {
							dataseries2 = data;
						}
					});
					
					/**
					 * 	do looping trough month jan to des for retrieving data inserted to tbldetail
					 *	or do insert to tbldetail
					 */	
					for (var i=0,  tot=periodnamearr.length;  i < tot;  i++) {
						
						var dataperiodmonth = null;
						$.ajax({
							'async': false,
							'global': false,
							'url': '/index.php/maincontroller/gettbldetail/'+idviewh+'/'+this.id+'/'+periodnamearr[i],
							//'url': '/performance_is/index.php/maincontroller/gettbldetail/'+idviewh+'/'+this.id+'/'+periodnamearr[i],
							'dataType': "json",
							'success': function (data) {
								dataperiodmonth = data;
							}
						});

						$("#"+periodnamearr[i]+"act").val(dataperiodmonth.actual);
						$("#"+periodnamearr[i]+"tar").val(dataperiodmonth.target);
						$("#"+periodnamearr[i]+"idx").val(dataperiodmonth.index + '%');
						$("#"+periodnamearr[i]+"targetvaridx").val(dataperiodmonth.targetvariance);
						$("#series1"+periodnamearr[i]+"act").val(dataperiodmonth.series1);
						$("#series1"+periodnamearr[i]+"varact").val(dataperiodmonth.series1variance);
						$("#series2"+periodnamearr[i]+"act").val(dataperiodmonth.series2);
						$("#series2"+periodnamearr[i]+"varact").val(dataperiodmonth.series2variance);
						
						// actual
						if(dataperiodmonth.actual == null){ $("#"+periodnamearr[i]+"act").css({'background-color' : '#A4A4A4'}); }
						else if(dataperiodmonth.actual != null){ $("#"+periodnamearr[i]+"act").css({'background-color' : '#FFFFFF'}); }

						// target
						if(dataperiodmonth.target == null){ $("#"+periodnamearr[i]+"tar").css({'background-color' : '#A4A4A4'}); }
						else if(dataperiodmonth.target != null){ $("#"+periodnamearr[i]+"tar").css({'background-color' : '#FFFFFF'}); }
	
						//series1janact
						if(dataperiodmonth.series1 == null){ $("#series1"+periodnamearr[i]+"act").css({'background-color' : '#A4A4A4'}); }
						else if(dataperiodmonth.series1 != null){ $("#series1"+periodnamearr[i]+"act").css({'background-color' : '#FFFFFF'}); }
						
						//series2janact
						if(dataperiodmonth.series2 == null){ $("#series2"+periodnamearr[i]+"act").css({'background-color' : '#A4A4A4'}); }
						else if(dataperiodmonth.series2 != null){ $("#series2"+periodnamearr[i]+"act").css({'background-color' : '#FFFFFF'}); }
						
						// actual and target
						$("#"+periodnamearr[i]+"head").show();
						$("#"+periodnamearr[i]+"title1").show();
						$("#"+periodnamearr[i]+"title2").show();
						$("#"+periodnamearr[i]+"title3").show();
						$("#"+periodnamearr[i]+"headtd1").show();
						$("#"+periodnamearr[i]+"headtd2").show();
						$("#"+periodnamearr[i]+"headtd3").show();
						
						// target variance
						$("#"+periodnamearr[i]+"targetvar").show();
						$("#"+periodnamearr[i]+"targetvartd3").show();
						
						if ( dataseries1 != null ) 
						{
							// series 1 and series1variance
							$(".series1label").text(dataseries1.name);
							$(".series1labelvariance").text(dataseries1.name + ' Variance' );
							$("#series1"+periodnamearr[i]).show();
							$("#series1"+periodnamearr[i]+"td1").show();
							$("#series1"+periodnamearr[i]+"var").show();
							$("#series1"+periodnamearr[i]+"vartd1").show();
						}
						
						if ( dataseries2 != null ) 
						{
							// series 2 and series2variance
							$(".series2label").text(dataseries2.name);
							$(".series2labelvariance").text(dataseries2.name + ' Variance' );
							$("#series2"+periodnamearr[i]).show();
							$("#series2"+periodnamearr[i]+"td1").show();
							$("#series2"+periodnamearr[i]+"var").show();
							$("#series2"+periodnamearr[i]+"vartd1").show();
						}
					}
					
				} else if(jenisform.storageperiod=='quarter')
				{
					$("#idmeasureq").val(this.id);
					$("#idviewq").val(idviewh);
					$("#idmeasureactcommQ").val(this.id);
					$("#periodquarter").dialog ("open"); 
					
					/* mengambil data action plan dan comment dan menampilkannya pada form period month */
					var dataactcomm = null;
					$.ajax({
						'async': false,
						'global': false,
						//'url': '/performance_is/index.php/maincontroller/getactcomm/'+iddb+'/'+this.id,
						'url': '/index.php/maincontroller/getactcomm/'+iddb+'/'+this.id,
						'dataType': "json",
						'success': function (data) {
							dataactcomm = data;
						}
					});
					
					if(dataactcomm == null){} else {
						$("#commentsQ").val(dataactcomm.commentary);
						$("#actionplansQ").val(dataactcomm.actionplan);
					}
					
					//var periodnamearr = ["Q1","Q2","Q3","Q4"];

					if(activeperiod=='Jan' || activeperiod=='Feb' || activeperiod=='Mar'){ var periodnamearr = ["Q1"]; }
					else if(activeperiod=='Apr' || activeperiod=='May' || activeperiod=='Jun'){ var periodnamearr = ["Q1","Q2"]; }
					else if(activeperiod=='Jul' || activeperiod=='Aug' || activeperiod=='Sep'){ var periodnamearr = ["Q1","Q2","Q3"]; }
					else if(activeperiod=='Sep' || activeperiod=='Oct' || activeperiod=='Dec'){ var periodnamearr = ["Q1","Q2","Q3","Q4"]; }

					for (var i=0,  tot=periodnamearr.length;  i < tot;  i++) {
						
						var dataperiodquarter = null;
						$.ajax({
							'async': false,
							'global': false,
							'url': '/index.php/maincontroller/gettbldetail/'+idviewh+'/'+this.id+'/'+periodnamearr[i],
							//'url': '/performance_is/index.php/maincontroller/gettbldetail/'+idviewh+'/'+this.id+'/'+periodnamearr[i],
							'dataType': "json",
							'success': function (data) {
								dataperiodquarter = data;
							}
						});
						
						
						$("#"+periodnamearr[i]+"act").val(dataperiodquarter.actual);
						$("#"+periodnamearr[i]+"tar").val(dataperiodquarter.target);

						$("#"+periodnamearr[i]+"head").show();
						$("#"+periodnamearr[i]+"title1").show();
						$("#"+periodnamearr[i]+"title2").show();
						$("#"+periodnamearr[i]+"title3").show();
						$("#"+periodnamearr[i]+"headtd1").show();
						$("#"+periodnamearr[i]+"headtd2").show();
						$("#"+periodnamearr[i]+"headtd3").show();
					}
					
				} else if(jenisform.storageperiod=='week')
				{
					$("#idmeasurew").val(this.id);
					$("#idvieww").val(idviewh);
					$("#periodweek").dialog ("open"); 
					
					var periodnamearr = ["W01","W02","W03","W04","W05","W06","W07","W08","W09","W10","W11","W12","W13","W14","W15","W16","W17","W18","W19","W20","W21","W22","W23","W24","W25","W26","W27","W28","W29","W30","W31","W32","W33","W34","W35","W36","W37","W38","W39","W40","W41","W42","W43","W44","W45","W46","W47","W48","W49","W50","W51","W52"];
					
					for (var i=0,  tot=periodnamearr.length;  i < tot;  i++) {
						
						var dataperiodweek = null;
						$.ajax({
							'async': false,
							'global': false,
							'url': '/index.php/maincontroller/gettbldetail/'+idviewh+'/'+this.id+'/'+periodnamearr[i],
							//'url': '/performance_is/index.php/maincontroller/gettbldetail/'+idviewh+'/'+this.id+'/'+periodnamearr[i],
							'dataType': "json",
							'success': function (data) {
								dataperiodweek = data;
							}
						});
						$("#"+periodnamearr[i]+"act").val(dataperiodweek.actual);
						$("#"+periodnamearr[i]+"tar").val(dataperiodweek.target);
					}
					
				}
				
			}));
			
			$("#savepenugasan").click (function (event) {
				$("#periodmonth").dialog ("close"); 
			});
			
			$("#btnDone").click (function (event) {
				$(this).dialog ("close"); 
			});
        },
        
        //This method is called on DOM label creation.
        //Use this method to add event handlers and styles to
        //your node.
        onCreateLabel: function(label, node){
            label.id = node.id;            
            if(node.data.type=='group' || node.data.type=='formula'){
            	st.height= 75;
        		
            	label.innerHTML = 
            	'<table style="font-size:1em;height:10px;line-height:12px;width:90%;margin-top:2px;" title="'+node.name+'">'+
					'<tr style="text-align:left;font-weight:bold;">'+
						'<td colspan="2" >'+node.name.substring(0, 19)+'</td>'+
					'</tr>'+ 
					'<tr style="text-align:left;font-weight:bold;">'+
						'<td colspan="2">'+node.data.location+'</td>'+
					'</tr>'+
					
					'<tr>'+
					'<tr>'+
						'<td style="text-align:left;">Index</td>'+
						'<td style="text-align:right;">'+node.data.index+'%</td>'+
					'</tr>'+
					
					'<tr>'+
						'<td style="text-align:left;">Owner</td>'+
						'<td style="text-align:right;">'+node.data.name+'</td>'+
					'</tr>'+
					
					'<tr>'+
						'<td style="text-align:left;">&nbsp;</td>'+
						'<td style="text-align:right;">&nbsp;</td>'+
					'</tr>'+
					
					'<tr >'+
						'<td style="text-align:left;">&nbsp;</td>'+
						'<td style="text-align:right;">&nbsp;</td>'+
					'</tr>'+
					'<tr>'+
						'<td style="text-align:left;">&nbsp;</td>'+
						'<td style="text-align:right;">&nbsp;</td>'+
					'</tr>	'+
					
					'<tr style="text-align:left;border-top:1px solid #000;">'+
						'<td colspan="2">&nbsp;</td>'+
					'</tr>'+
					
				'</table>';
            } else {
            label.innerHTML = 
				/*
				'<span style="text-align:left">'+node.name+'</span><br />' + 
				'<span style="font-size:8px;text-align:left">'+ node.data.location + '</span><br />' +
				'<span style="font-size:8px;text-align:left">Actual</span>'+'<span style="font-size:8px;text-align:right">'+ node.data.actual + '</span><br />' + 
				'<span style="font-size:8px;">' + node.data.target + '</span><br />' + 
				'<span style="font-size:8px;">'+ node.data.index + '</span><br />' + 
				'<span style="font-size:8px;">'+ node.data.weight + '</span><br />' + 
				'<span style="font-size:8px;">'+ node.data.owner +'</span>';
				*/
				
				'<table style="font-size:1em;height:10px;line-height:12px;width:90%;margin-top:2px;" title="'+node.name+'">'+
					'<tr style="text-align:left;font-weight:bold;">'+
						'<td colspan="2" >'+node.name.substring(0, 19)+'</td>'+
					'</tr>'+ 
					'<tr style="text-align:left;font-weight:bold;">'+
						'<td colspan="2">'+node.data.location+'</td>'+
					'</tr>'+
					'<tr >'+
						'<td style="text-align:left;">Actual</td>'+
						'<td style="text-align:right;">'+node.data.actual+'</td>'+
					'</tr>'+
					'<tr>'+
						'<td style="text-align:left;">Target</td>'+
						'<td style="text-align:right;">'+node.data.target+'</td>'+
					'</tr>	'+
					'<tr>'+
						'<td style="text-align:left;">Index</td>'+
						'<td style="text-align:right;">'+node.data.index+'%</td>'+
					'</tr>'+
					'<tr>'+
						'<td style="text-align:left;">Weight</td>'+
						'<td style="text-align:right;">'+node.data.weight+'%</td>'+
					'</tr>'+
					'<tr>'+
						'<td style="text-align:left;">Owner</td>'+
						'<td style="text-align:right;">'+node.data.name+'</td>'+
					'</tr>'+
					'<tr style="text-align:left;border-top:1px solid #000;">'+
						'<td colspan="2"><a href="#" class="openpenugasan" id='+node.id+' style="color:#000;"><img src="http://performance_is.net/libs/img/text-plus-icon.png" style="max-width:13px;max-height:13px;"></img> Data Entry</a></td>'+
					'</tr>'+
				'</table>';
			}

				/*
				'<tr class="entry" style="text-align:left;border-top:1px solid #000;">'+
						'<td colspan="2"><a href="#" class="openpenugasan" id='+node.id+' style="color:#000;"><img src="http://owbis.net/libs/img/text-plus-icon.png" style="max-width:13px;max-height:13px;"></img> Data Entry</a></td>'+
					'</tr>'
					
					'<td colspan="2"><a href="#" class="openpenugasan" id='+node.id+' style="color:#000;"><img src="http://owbis.net/libs/img/text-plus-icon.png" style="max-width:13px;max-height:13px;"></img> Data Entry</a></td>'+
					
					'<td colspan="2"><a href="#" class="openpenugasan" id='+node.id+' style="color:#000;"><img src="http://localhost/performance_is/libs/img/text-plus-icon.png" style="max-width:13px;max-height:13px;"></img> Data Entry</a></td>'+
				*/
				
            label.onclick = function(){
			    if(normal.checked) {
            	  st.onClick(node.id);
            	} else {
                st.setRoot(node.id, 'animate');
            	}
            };
			
            //set label styles
            var style = label.style;
            style.width = 140 + 'px';
            style.height = 17 + 'px';
            style.cursor = 'pointer';
			if(node.data.index<80) {
				style.color = '#fff';
			} else {
				style.color = '#333';
			}
            
            style.fontSize = '0.8em';
            style.textAlign= 'center';
            style.paddingTop = '3px';

        },
        
        //This method is called right before plotting
        //a node. It's useful for changing an individual node
        //style properties before plotting it.
        //The data properties prefixed with a dollar
        //sign will override the global node style properties.
        onBeforePlotNode: function(node){
            //add some color to the nodes in the path between the
            //root node and the selected node.
            /*
			if(node.data.index>=120){
				node.data.$color = "#00FF00";
			}
			else if(node.data.index>=80){
				node.data.$color = "#FFFF00";
			}
			else if(node.data.index<80){
				node.data.$color = "#DF0101";
			}
			*/
			

			if( node.data.index>=parseFloat(dataranges.valuebottom5)){
				node.data.$color = dataranges.colors5;
			}
			else if(node.data.index>=parseFloat(dataranges.valuebottom4)){
				node.data.$color = dataranges.colors4;
			}
			else if(node.data.index>=parseFloat(dataranges.valuebottom3)){
				node.data.$color = dataranges.colors3;
			}
			else if(node.data.index>=parseFloat(dataranges.valuebottom2)){
				node.data.$color = dataranges.colors2;
			}
			else if(node.data.index>=parseFloat(dataranges.valuebottom1)){
				node.data.$color = dataranges.colors1;
			}
			
			/*
            if (node.selected) {
                node.data.$color = "#ff7";
            }
            else {
                delete node.data.$color;
                //if the node belongs to the last plotted level
                if(!node.anySubnode("exist")) {
                    //count children number
                    var count = 0;
                    node.eachSubnode(function(n) { count++; });
                    //assign a node color based on
                    //how many children it has
                    node.data.$color = ['#aaa', '#baa', '#caa', '#daa', '#eaa', '#faa'][count];                    
                }
            }
			*/
        },
        
        //This method is called right before plotting
        //an edge. It's useful for changing an individual edge
        //style properties before plotting it.
        //Edge data proprties prefixed with a dollar sign will
        //override the Edge global style properties.
        onBeforePlotLine: function(adj){
            if (adj.nodeFrom.selected && adj.nodeTo.selected) {
                adj.data.$color = "#eed";
                adj.data.$lineWidth = 3;
            }
            else {
                delete adj.data.$color;
                delete adj.data.$lineWidth;
            }
        },
		onAfterPlotNode: function() {
			edge:{
			lineWidth = 3,
			color='#3B5998'
			}

			
		}
    });
    //load json data
    st.loadJSON(json);
    //compute node positions and layout
    st.compute();
    //optional: make a translation of the tree
    st.geom.translate(new $jit.Complex(-200, 0), "current");
    //emulate a click on the root node.
    st.onClick(st.root);
    //end
    //Add event handlers to switch spacetree orientation.
    var top = $jit.id('r-top'), 
        left = $jit.id('r-left'), 
        bottom = $jit.id('r-bottom'), 
        right = $jit.id('r-right'),
        normal = $jit.id('s-normal');
        
    
    function changeHandler() {
        if(this.checked) {
            top.disabled = bottom.disabled = right.disabled = left.disabled = true;
			//st.switchPosition("top", "", "");
			
            st.switchPosition(this.value, "animate", {
                onComplete: function(){
                    top.disabled = bottom.disabled = right.disabled = left.disabled = false;
					
                }
            });
        }
    };
    
    //top.onchange = left.onchange = bottom.onchange = right.onchange = changeHandler;
    //end

}
