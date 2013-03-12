function addHiddenFields() {
    var form = document.forms[0];
    var resolution = document.createElement('input');
    resolution.setAttribute('id', 'screenResolution');
    resolution.setAttribute('type', 'hidden');
    resolution.setAttribute('name', 'screenResolution');
    var resolutionString = screen.width + 'x' + screen.height;
    resolution.setAttribute('value', resolutionString);
    form.appendChild(resolution);
    var pluginString = '';
    if (window.ActiveXObject) {
        var activeXNames = {'AcroPDF.PDF':'Adobe Reader',
            'ShockwaveFlash.ShockwaveFlash':'Flash',
            'QuickTime.QuickTime':'Quick Time',
            'SWCtl':'Shockwave',
            'WMPLayer.OCX':'Windows Media Player',
            'AgControl.AgControl':'Silverlight'};
        var plugin = null;
        for (var activeKey in activeXNames) {
            try {
                plugin = null;
                plugin = new ActiveXObject(activeKey);
            } catch (e) {
                // do nothing, the plugin is not installed
            }
            pluginString += activeXNames[activeKey] + ',';
        }
        var realPlayerNames = ['rmockx.RealPlayer G2 Control',
            'rmocx.RealPlayer G2 Control.1',
            'RealPlayer.RealPlayer(tm) ActiveX Control (32-bit)',
            'RealVideo.RealVideo(tm) ActiveX Control (32-bit)',
            'RealPlayer'];
        for (var index = 0; index < realPlayerNames.length; index++) {
            try {
                plugin = new ActiveXObject(realPlayerNames[index]);
            } catch (e) {
                continue;
            }
            if (plugin) {
                break;
            }
        }
        if (plugin) {
            pluginString += 'RealPlayer,';
        }
    } else {
        for (var i = 0; i < navigator.plugins.length; i++) {
            pluginString += navigator.plugins[i].name + ',';
        }
    }
    pluginString = pluginString.substring(0, pluginString.lastIndexOf(','));
    var plugins = document.createElement('input');
    plugins.setAttribute('id', 'pluginList');
    plugins.setAttribute('type', 'hidden');
    plugins.setAttribute('name', 'pluginList');
    plugins.setAttribute('value', pluginString);
    form.appendChild(plugins);
    var java = navigator.javaEnabled();
    var javaEnabled = document.createElement('input');
    javaEnabled.setAttribute('id', 'javaEnabled');
    javaEnabled.setAttribute('type', 'hidden');
    javaEnabled.setAttribute('name', 'javaEnabled');
    javaEnabled.setAttribute('value', java);
    form.appendChild(javaEnabled);
}
