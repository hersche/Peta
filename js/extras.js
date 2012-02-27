    dojo.require("dijit.form.Button");
    dojo.require("dojo.fx");
    function basicWipeinSetup() {
        //Function linked to the button to trigger the wipe.
        function wipeIt() {
            dojo.style("messagebox", "height", "");
            dojo.style("messagebox", "display", "block");
            var wipeArgs = {
                node: "messagebox"
            };
            dojo.fx.wipeOut(wipeArgs).play();
        }
        dojo.connect(dijit.byId("messageboxclosebutton"), "onClick", wipeIt);
    }
    function addLine(targetElement){
    	
    }
        function showHide(elementId){
	 $('#'+elementId).toggle();
    }
    dojo.addOnLoad(basicWipeinSetup);

