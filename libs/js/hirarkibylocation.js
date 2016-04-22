var labelType, useGradients, nativeTextSupport, animate;

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
			'url': '/performance_is/index.php/maincontroller/gethirarkikpibylocation',
			'dataType': "json",
			'success': function (data) {
				json = data;
			}
		});
		return json;
	})(); 
		
	/*
    var json = {
        id: "node02",
        name: "Laba",
        data: {
			target: 90,
		},
        children: [{
            id: "node13",
            name: "Pendapatan",
            data: {
				target: 70,
			},
            children: []
        }, {
            id: "node125",
            name: "Biaya Operasional",
            data: {
				target: 90,
			},
            children: [{
                id: "node226",
                name: "Biaya Bahan Bakar",
                data: {
					target: 130,
				},
                children: []
				}]
        }, {
            id: "node165",
            name: "Biaya Karyawan",
            data: {
				target: 130,
			},
            children: [{
                id: "node266",
                name: "Biaya Upah",
                data: {
					target: 130,
				},
                children: [{
                    id: "node367",
                    name: "Gaji",
                    data: {
						target: 90,
					},
                    children: []
                }, {
                    id: "node372",
                    name: "Lembur",
                    data: {
						target: 70,
					},
                    children: []
                }]
            
            }]
        }]
    };
	*/
	
    //end
    //init Spacetree
    //Create a new ST instance
    var stlocation = new $jit.ST({
        //id of viz container element
		orientation: 'top',
        injectInto: 'infovislocation',
        //set duration for the animation
        duration: 800,
        //set animation transition type
        transition: $jit.Trans.Quart.easeInOut,
        //set distance between node and its children
        levelDistance: 50,
        //enable panning
        Navigation: {
          enable:true,
          panning:true
        },
        //set node and edge styles
        //set overridable=true for styling individual
        //nodes or edges
        Node: {
            height: 70,
            width: 110,
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
        },
        
        onAfterCompute: function(){
            //Log.write("done");
        },
        
        //This method is called on DOM label creation.
        //Use this method to add event handlers and styles to
        //your node.
        onCreateLabel: function(label, node){
            label.id = node.id;            
            label.innerHTML = node.name;
            label.onclick = function(){
            	if(normal.checked) {
            	  stlocation.onClick(node.id);
            	} else {
                stlocation.setRoot(node.id, 'animate');
            	}
            };
            //set label styles
            var style = label.style;
            style.width = 110 + 'px';
            style.height = 17 + 'px';            
            style.cursor = 'pointer';
			if(node.data.target<80) {
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
			if(node.data.target>=120){
				node.data.$color = "#00FF00";
			}
			else if(node.data.target>=80){
				node.data.$color = "#FFFF00";
			}
			else if(node.data.target<80){
				node.data.$color = "#DF0101";
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
    stlocation.loadJSON(json);
    //compute node positions and layout
    stlocation.compute();
    //optional: make a translation of the tree
    stlocation.geom.translate(new $jit.Complex(-200, 0), "current");
    //emulate a click on the root node.
    stlocation.onClick(stlocation.root);
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
			
            stlocation.switchPosition(this.value, "animate", {
                onComplete: function(){
                    top.disabled = bottom.disabled = right.disabled = left.disabled = false;
                }
            });
        }
    };
    
    top.onchange = left.onchange = bottom.onchange = right.onchange = changeHandler;
    //end

}
