    dojo.require("dijit.form.Button");
    dojo.require("dojo.fx");
    function basicWipeinSetup() {
        //Function linked to the button to trigger the wipe.
        function wipeIt() {
            dojo.style("basicWipeNode", "height", "");
            dojo.style("basicWipeNode", "display", "block");
            var wipeArgs = {
                node: "basicWipeNode"
            };
            dojo.fx.wipeOut(wipeArgs).play();
        }
        dojo.connect(dijit.byId("basicWipeButton"), "onClick", wipeIt);
    }
    dojo.addOnLoad(basicWipeinSetup);

